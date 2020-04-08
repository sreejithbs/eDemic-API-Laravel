<?php

namespace App\Http\Controllers\API\v1;

// use Illuminate\Http\Request;
use App\Http\Requests\API\DeviceTokenRequest;
use App\Http\Controllers\Controller;

use Auth;
use ConstantHelper;

use App\Models\Message;
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
                ->get(['id', 'title', 'content']);

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
                    array( 'code' => 5001, 'qr_code' => asset($disease['infectionQrCode']) ),
                    array( 'code' => 5002, 'qr_code' => asset($disease['recoveredQrCode']) ),
                    array( 'code' => 5003, 'qr_code' => asset($disease['deadQrCode']) ),
                    array( 'code' => 5004, 'qr_code' => asset($disease['selfQuarantineQrCode']) )
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