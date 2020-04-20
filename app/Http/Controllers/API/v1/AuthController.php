<?php

namespace App\Http\Controllers\API\v1;

// use Illuminate\Http\Request;
use App\Http\Requests\API\UserOtpRequest;
use App\Http\Controllers\Controller;

use Auth, DB;
use Validator;
use Carbon\Carbon;
use ConstantHelper;
use StringHelper;
use Twilio\Rest\Client;
use Twilio\Exceptions\TwilioException;
// use Exception;

use App\Models\User;
use App\Models\Disease;

class AuthController extends Controller
{
    /**
     * @OA\Post(path="/auth/sendOtp",
     *     tags={"Authentication"},
     *     summary="Send SMS verification OTP code for users",
     *     description="API to send SMS verification OTP code for users. <br><br>Accepts `phone_number` and either `android_device_id` or `ios_device_id`.",
     *     operationId="sendOtp",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(property="phone_number", type="string"),
     *                 @OA\Property(property="android_device_id", type="string"),
     *                 @OA\Property(property="ios_device_id", type="string"),
     *                 example={
     *                     "phone_number": "+918943406910",
     *                     "android_device_id": "9774d56d682e549c",
     *                     "ios_device_id": "",
     *                 },
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful Operation",
     *     )
     * )
     */
    public function sendOtp(UserOtpRequest $request)
    {
        $recipient = $request->phone_number;
        try {
            $twilioCreds = $this->_fetchTwilioCreds();
            $twilioNumber = $twilioCreds['from'];
            $code = mt_rand(100000, 999999);

            $client = new Client($twilioCreds['account_sid'], $twilioCreds['auth_token']);
            $client->messages->create(
                $recipient,
                [
                    "from" => $twilioNumber,
                    "body" => "# Welcome to e-Demic. Your OTP Verification Code : ".$code." ".config('services.sms_otp_hashKey')
                ]
            );

            $user = User::firstOrNew(['phone' => $recipient]);
            if(! $user->exists){
                $user->userCode = 'U' . StringHelper::randString(7);

                $phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
                try {
                    $isoAlphaCode = $phoneUtil->getRegionCodeForNumber( $phoneUtil->parse($recipient) );
                    $user->country_id = DB::table('countries')->where('isoAlphaCode', $isoAlphaCode)->value('id');
                } catch (\libphonenumber\NumberParseException $e) {
                    //
                }
            }
            if($request->has('android_device_id')){
                $user->androidDeviceId = $request->android_device_id;
            } else{
                $user->iosDeviceId = $request->ios_device_id;
            }
            $user->isVerified = 0;
            $user->verificationNonce = $code;
            $user->save();

            return response()->json([
                'status' => ConstantHelper::STATUS_OK,
                'message' => 'Verification code has been sent to your mobile number'
            ], ConstantHelper::STATUS_OK);

        } catch (TwilioException $e) {
            logger("sendOtp : " . $e->getMessage());
            return response()->json([
                'status' => ConstantHelper::STATUS_UNPROCESSABLE_ENTITY,
                'error' => [
                    'code' => 2000,
                    'message'=> 'Error sending verification code to your mobile number'
                ],
            ], ConstantHelper::STATUS_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * Fetch Twilio's programmable sms client credentials
     */
    private function _fetchTwilioCreds()
    {
        $twilioCreds = config('services.twilio');

        if( $twilioCreds['mode'] === 'test'){
            return array(
                "auth_token" => $twilioCreds['test_auth_token'],
                "account_sid" => $twilioCreds['test_account_sid'],
                "from" => $twilioCreds['test_from']
            );
        } elseif( $twilioCreds['mode'] === 'live' ){
            return array(
                "auth_token" => $twilioCreds['live_auth_token'],
                "account_sid" => $twilioCreds['live_account_sid'],
                "from" => $twilioCreds['live_from']
            );
        }
    }

    /**
     * @OA\Post(path="/auth/verifyOtp",
     *     tags={"Authentication"},
     *     summary="Verify user entered OTP code",
     *     description="API to verify user entered OTP code. <br><br>Accepts `phone_number` and `code`. Returns `token` for user authorization purpose.",
     *     operationId="verifyOtp",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(property="phone_number", type="string"),
     *                 @OA\Property(property="otp_code", type="integer"),
     *                 example={
     *                     "phone_number": "+918943406910",
     *                     "otp_code": 123456,
     *                 },
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful Operation",
     *     )
     * )
     */
    public function verifyOtp(UserOtpRequest $request)
    {
        if( $user = User::where('phone', $request->phone_number)->first() ){
            if($user->verificationNonce == $request->otp_code){
                $user->verificationNonce = null;
                $user->isVerified = 1;
                $user->save();

                // Delete all existing App sessions
                $existingUserTokens = $user->tokens;
                foreach($existingUserTokens as $token) {
                    $token->revoke();
                    $token->delete();
                }

                Auth::loginUsingId($user->id);
                $objToken = $user->createToken('API Access Token');

                $data['token_type'] = "Bearer";
                $data['token_expiry'] = $objToken->token->expires_at->format('Y-m-d H:i:s');
                $data['token'] = $objToken->accessToken;
                $data['codes'] = array_merge(config('app-status-codes'), Disease::fetchAllDiseasesApi());

                $user_diagnosis_logs = $user->patients()->get();
                if($user_diagnosis_logs->isNotEmpty()){
                    foreach ($user_diagnosis_logs as $user_diagnosis_log) {

                        $tempArr = array();
                        $tempArr = array(
                            'disease_code' => (int)$user_diagnosis_log->disease_id + 6000,
                            'stage_code' => (int)$user_diagnosis_log->stage + 5000,
                            'diagnosed_date_time' => $user_diagnosis_log->diagnosisDateTime,
                        );

                        $patientArr['patient_details'][] = $tempArr;
                    }
                } else{
                    $patientArr['patient_details'] = null;
                }

                $data['user_details'] = $patientArr;

                return response()->json([
                    'status' => ConstantHelper::STATUS_OK,
                    'message' => 'You are successfully authenticated',
                    'data' => $data
                ], ConstantHelper::STATUS_OK);

            } else{
                return response()->json([
                    'status' => ConstantHelper::STATUS_UNPROCESSABLE_ENTITY,
                    'error' => [
                        'code' => 1003,
                        'message'=> 'Invalid verification code'
                    ],
                ], ConstantHelper::STATUS_UNPROCESSABLE_ENTITY);
            }
        } else {
            return response()->json([
                'status' => ConstantHelper::STATUS_UNPROCESSABLE_ENTITY,
                'error' => [
                    'code' => 1002,
                    'message'=> 'No matching phone number record exists'
                ],
            ], ConstantHelper::STATUS_UNPROCESSABLE_ENTITY);
        }
    }
}