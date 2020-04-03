<?php

namespace App\Http\Controllers\API\v1;

// use Illuminate\Http\Request;
use App\Http\Requests\API\UserValidateRequest;
use App\Http\Requests\API\LoginHandleRequest;
use App\Http\Controllers\Controller;

use Auth;
use Validator;
use Carbon\Carbon;
use ConstantHelper;
use StringHelper;
use Twilio\Rest\Client;
use Twilio\Exceptions\TwilioException;
// use Exception;

use App\Models\User;

class UserController extends Controller
{
    /**
     * @OA\Post(path="/user/validate",
     *     tags={"Users"},
     *     summary="Check if a user is an existing or a new one",
     *     description="API to check if a user is an existing or a new one, using their phone number. <br><br>Returns either `existing` or `new` user status.",
     *     operationId="userValidate",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(property="phone_number", type="string"),
     *                 example={
     *                     "phone_number": "+919219592195",
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
    public function userValidate(UserValidateRequest $request)
    {
        $user = User::where('phone', $request->phone_number)->first();
        if ($user){
            return response()->json(['status' => true, 'user_type'=> 'existing'], ConstantHelper::STATUS_OK);
        } else{
            return response()->json(['status' => true, 'user_type'=> 'new'], ConstantHelper::STATUS_OK);
        }
    }

    /**
     * @OA\Post(path="/user/sendSmsOtp",
     *     tags={"Users"},
     *     summary="Send SMS verification code for new users",
     *     description="API to send SMS verification code for new users. <br><br>Returns `code` for OTP verification purpose.",
     *     operationId="sendSmsOtp",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(property="phone_number", type="string"),
     *                 example={
     *                     "phone_number": "+355683370083",
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
    public function sendSmsOtp(UserValidateRequest $request)
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
                    "body" => "Welcome to e-Demic. Your Verification Code is " . $code
                ]
            );

            return response()->json(['status' => true, 'code'=> $code, "message" => "Verification Code has been sent to your mobile number"], ConstantHelper::STATUS_OK);

        } catch (TwilioException $e) {
            // return $e->getMessage();
            return response()->json(['status' => false, 'message'=> 'Error sending verification Code to your mobile number'], ConstantHelper::STATUS_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * Fetch Twilio's programmable sms client credentials
     */
    private function _fetchTwilioCreds()
    {
        $twilioCreds = config('services.twilio' );

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
     * @OA\Post(path="/user/registerAndLogin",
     *     tags={"Users"},
     *     summary="Login an existing user as well as new user, after successful registration of a new user",
     *     description="API to login an existing user as well as new user. In-case of new one, user is registered before attempting login. Boolean `user_verified` value is needed for both existing and new user. <br><br>Returns `token` for later user authorization purpose.",
     *     operationId="registerAndLogin",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(property="phone_number", type="string"),
     *                 @OA\Property(property="user_verified", type="boolean"),
     *                 @OA\Property(property="android_device_token", type="string"),
     *                 @OA\Property(property="ios_device_token", type="string"),
     *                 example={
     *                     "phone_number": "+919219592195",
     *                     "user_verified": true,
     *                     "android_device_token" : "08a2f5d1-c567-4334-b156-e037c63f8a41",
     *                     "ios_device_token" : ""
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
    public function registerAndLogin(LoginHandleRequest $request)
    {
        if($request->user_verified){
            $user = User::firstOrNew(['phone' => $request->phone_number]);
            $user->userCode = 'U' . StringHelper::randString(7);
            if( $request->has('android_device_token') ){
                $user->androidDeviceToken = $request->android_device_token;
                $os = 'Android';
            } else{
                $user->iosDeviceToken = $request->ios_device_token;
                $os = 'iOS';
            }
            $user->save();

            Auth::loginUsingId($user->id);
            $data['token'] = $user->createToken('eDemic Access' .$os. ' Token')->accessToken;
            $data['user_id'] = $user->id;

            return response()->json(['status' => true, 'message'=> 'You are successfully authenticated', 'data'=> $data], ConstantHelper::STATUS_OK);
        } else{
            return response()->json(['status' => false, 'message'=> 'User verification failed'], ConstantHelper::STATUS_UNAUTHORIZED);
        }
    }

}