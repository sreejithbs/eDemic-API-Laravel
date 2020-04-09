<?php

namespace App\Http\Controllers\API\v1;

// use Illuminate\Http\Request;
use App\Http\Requests\API\DeviceTokenRequest;
use App\Http\Controllers\Controller;

use Auth;
use ConstantHelper;

use App\Models\Message;
use App\Models\DoctorProfile;
use App\Models\Disease;

class UserController extends Controller
{
    /**
    * @OA\Get(path="/messages/{index}",
    *   tags={"Messages"},
    *   summary="List all messages",
    *   description="API to list all messages, such as alerts, announcements etc on latest first basis. Default limit set as **3** messages per page. <br><br>Accepts `index` for lazy load messages.",
    *   operationId="messages",
    *   @OA\Parameter(
    *       name="index",
    *       in="path",
    *       description="Page index to fetch messages",
    *       required=true,
    *       @OA\Schema(
    *           type="integer",
    *           format="int64",
    *           example=1
    *       ),
    *   ),
    *   @OA\Response(
    *       response=200,
    *       description="Successful Operation",
    *       @OA\JsonContent()
    *   ),
    *   security={
    *       {"api_key": {}}
    *   },
    * )
    */
    public function messages($index)
    {
        $limit = 3;
        $messages = Message::isPosted()
                ->latest()
                ->skip(($index - 1) * $limit)->take($limit)
                ->get(['id', 'title', 'content', 'created_at']);

        if($messages->isNotEmpty()){
            return response()->json([
                'status' => ConstantHelper::STATUS_OK,
                'message' => 'Messages List',
                'page' => $index,
                'data' => $messages->toArray()
            ], ConstantHelper::STATUS_OK);
        } else{
            return response()->json([
                'status' => ConstantHelper::STATUS_UNPROCESSABLE_ENTITY,
                'error' => [
                    'code' => 1004,
                    'message'=> 'No more messages to show'
                ],
            ], ConstantHelper::STATUS_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * @OA\Post(path="/user/updateDeviceToken",
     *     tags={"Users"},
     *     summary="Update device token for push notification",
     *     description="API to update device token for push notification. <br><br>Accepts either `android_device_token` or `ios_device_token`.",
     *     operationId="updateDeviceToken",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(property="android_device_token", type="string"),
     *                 @OA\Property(property="ios_device_token", type="string"),
     *                 example={
     *                     "android_device_token": "08a2f5d1-c567-4334-b156-e037c63f8a41",
     *                     "ios_device_token": "",
     *                 },
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful Operation",
     *         @OA\JsonContent()
     *     ),
     *     security={
     *          {"api_key": {}}
     *     },
     * )
     */
    public function updateDeviceToken(DeviceTokenRequest $request)
    {
        $user = Auth::user();
        if($request->has('android_device_token')){
            $user->androidPushToken = $request->android_device_token;
        } else{
            $user->iosPushToken = $request->ios_device_token;
        }
        $user->save();

        return response()->json([
            'status' => ConstantHelper::STATUS_OK,
            'message' => 'Device token has been updated successfully'
        ], ConstantHelper::STATUS_OK);
    }

    /**
    * @OA\Get(path="/doctor/fetchProfile/{doctor_id}",
    *   tags={"Doctor Users"},
    *   summary="Fetch doctor user profile details",
    *   description="API to fetch doctor user profile details using the ID from doctor's Profile QR Code. <br><br>Accepts `doctor_id`.",
    *   operationId="fetchDoctorProfile",
    *   @OA\Parameter(
    *       name="doctor_id",
    *       in="path",
    *       description="Doctor ID to fetch profile",
    *       required=true,
    *       @OA\Schema(
    *           type="integer",
    *           format="int64",
    *           example=1
    *       ),
    *   ),
    *   @OA\Response(
    *       response=200,
    *       description="Successful Operation",
    *       @OA\JsonContent()
    *   ),
    *   security={
    *       {"api_key": {}}
    *   },
    * )
    */
    public function fetchDoctorProfile($doctor_id)
    {
        $doctor = DoctorProfile::find($doctor_id);
        if( $doctor ){
            if( Auth::user()->is_doctor_id ){
                return response()->json([
                    'status' => ConstantHelper::STATUS_FORBIDDEN,
                    'error' => [
                        'code' => 1001,
                        'message'=> 'User account is already mapped to another Doctor Profile.'
                    ],
                ], ConstantHelper::STATUS_FORBIDDEN);
            }
            else if( $doctor->user()->exists() ){
                return response()->json([
                    'status' => ConstantHelper::STATUS_FORBIDDEN,
                    'error' => [
                        'code' => 1001,
                        'message'=> 'Doctor Profile is already mapped to another user account.'
                    ],
                ], ConstantHelper::STATUS_FORBIDDEN);
            }
            else {
                $user = Auth::user();
                $user->is_doctor_id = $doctor_id;
                $user->save();

                $data['id'] = $doctor->id;
                $data['name'] = $doctor->name;
                $data['health_institution'] = $doctor->health_institution->name;

                return response()->json([
                    'status' => ConstantHelper::STATUS_OK,
                    'message' => 'Doctor Profile',
                    'data' => $data
                ], ConstantHelper::STATUS_OK);
            }
        } else {
            return response()->json([
                'status' => ConstantHelper::STATUS_UNPROCESSABLE_ENTITY,
                'error' => [
                    'code' => 1002,
                    'message'=> 'No matching doctor record exists'
                ],
            ], ConstantHelper::STATUS_UNPROCESSABLE_ENTITY);
        }
    }

    /**
    * @OA\Get(path="/diseases",
    *   tags={"Diseases"},
    *   summary="List all diseases",
    *   description="API to list all diseases.",
    *   operationId="diseases",
    *   @OA\Response(
    *       response=200,
    *       description="Successful Operation",
    *       @OA\JsonContent()
    *   ),
    *   security={
    *       {"api_key": {}}
    *   },
    * )
    */
    public function diseases()
    {
        $dataArr = array();
        foreach (Disease::all() as $disease) {
            $dataArr[] = [
                'code' => $disease['apiStatusCode'],
                'name' => $disease['name'],
                'stages' => [
                    array( 'code' => 5001, 'uid' => $disease['diseaseCode'], 'qr_code' => asset($disease['infectionQrCode']) ),
                    array( 'code' => 5002, 'uid' => $disease['diseaseCode'], 'qr_code' => asset($disease['recoveredQrCode']) ),
                    array( 'code' => 5003, 'uid' => $disease['diseaseCode'], 'qr_code' => asset($disease['deadQrCode']) ),
                    array( 'code' => 5004, 'uid' => $disease['diseaseCode'], 'qr_code' => asset($disease['selfQuarantineQrCode']) )
                ]
            ];
        }

        if(count($dataArr) > 0){
            return response()->json([
                'status' => ConstantHelper::STATUS_OK,
                'message' => 'Diseases List',
                'data' => $dataArr
            ], ConstantHelper::STATUS_OK);
        } else{
            return response()->json([
                'status' => ConstantHelper::STATUS_UNPROCESSABLE_ENTITY,
                'error' => [
                    'code' => 1004,
                    'message'=> 'No disease records to show'
                ],
            ], ConstantHelper::STATUS_UNPROCESSABLE_ENTITY);
        }
    }
}