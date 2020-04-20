<?php

namespace App\Http\Controllers\API\v1;

// use Illuminate\Http\Request;
use App\Http\Requests\API\DeviceTokenRequest;
use App\Http\Requests\API\QuarantinedUserRequest;
use App\Http\Requests\API\PatientDiagnosedRequest;
use App\Http\Requests\API\UserLocationRequest;
use App\Http\Controllers\Controller;

use Auth;
use Carbon\Carbon;
use ConstantHelper;
use Edujugon\PushNotification\PushNotification;

use App\Models\User;
use App\Models\Message;
use App\Models\DoctorProfile;
use App\Models\Disease;
use App\Models\UserDiagnosisLog;
use App\Models\UserLocationLog;

class UserController extends Controller
{
    /**
    * @OA\Get(path="/messages/{index}",
    *   tags={"Messages"},
    *   summary="List all messages",
    *   description="API to list all messages, such as alerts, announcements etc on latest first basis. Default limit set as **10** messages per page. <br><br>Accepts `index` for lazy load messages.",
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
        $limit = 10;
        $offset = ($index - 1) * $limit;

        $message_count = Message::isPosted()->count();
        $messages = Message::isPosted()
                ->latest('id')
                ->skip($offset)->take($limit)
                ->get(['id', 'title', 'content', 'created_at']);

        if($messages->isNotEmpty()){
            return response()->json([
                'status' => ConstantHelper::STATUS_OK,
                'message' => 'Messages List',
                'page' => (int)$index,
                'has_more_available' => ($message_count > ($offset + $limit)) ? true : false,
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
     *                     "android_device_token": "654C4DB3-3F68-4969-8ED2-80EA16B46EB0",
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
            $user->iosPushToken = null;
        } else{
            $user->iosPushToken = $request->ios_device_token;
            $user->androidPushToken = null;
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
                        'message'=> 'User account is already mapped to a Doctor Profile.'
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
                'uid' => $disease['diseaseCode'],
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

    /**
     * @OA\Post(path="/user/quarantinedLocation",
     *     tags={"Users"},
     *     summary="Update quarantine user details",
     *     description="API to update quarantine user details to be saved in database.",
     *     operationId="quarantinedLocation",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(property="disease_code", type="integer", example=6001),
     *                 @OA\Property(property="quarantined_date_time", type="string", example="2020-04-08 07:23:37"),
     *                 @OA\Property(property="location_date_time", type="string", example="2020-04-08 07:23:37"),
     *                 @OA\Property(property="latitude", type="string", example="51.528308"),
     *                 @OA\Property(property="longitude", type="string", example="-0.131847"),
     *                 @OA\Property(property="address", type="string", example="8-14 Eversholt St, Kings Cross, London NW1 1DG, UK"),
     *             ),
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
    public function quarantinedLocation(QuarantinedUserRequest $request)
    {
        $user = Auth::user();
        $disease_id = (int)$request->disease_code - 6000;
        $stage = Disease::SELF_QUARANTINE_STATUS;

        $match = UserDiagnosisLog::where([
            [ 'patient_id', '=', $user->id ],
            [ 'disease_id', '=', $disease_id ],
            [ 'stage', '=', $stage ],
        ])->first();

        if($match){
            return response()->json([
                'status' => ConstantHelper::STATUS_FORBIDDEN,
                'error' => [
                    'code' => 1001,
                    'message'=> 'User details with same disease and quarantine stage already exist in records'
                ],
            ], ConstantHelper::STATUS_FORBIDDEN);
        }

        $disease = Disease::find($disease_id);

        $diagnosis_log = new UserDiagnosisLog();
        $diagnosis_log->disease_id = $disease->id;
        $diagnosis_log->diagnosisDateTime = Carbon::parse($request->quarantined_date_time)->format('Y-m-d H:i:s');
        $diagnosis_log->stage = $stage;
        $user->patients()->save($diagnosis_log);

        $location_log = new UserLocationLog();
        $location_log->dateTime = Carbon::parse($request->location_date_time)->format('Y-m-d H:i:s');
        $location_log->latitude = $request->latitude;
        $location_log->longitude = $request->longitude;
        $location_log->address = $request->address;
        $diagnosis_log->user_location_logs()->save($location_log);

        return response()->json([
            'status' => ConstantHelper::STATUS_OK,
            'message' => 'Quarantined User details has been recorded successfully',
        ], ConstantHelper::STATUS_OK);
    }

    /**
     * @OA\Post(path="/user/diseaseDiagnosed",
     *     tags={"Users"},
     *     summary="Submit disease diagnosed patient details",
     *     description="API to submit disease diagnosed patient details to be saved in database.",
     *     operationId="diseaseDiagnosed",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(property="disease_code", type="integer", example=6001),
     *                 @OA\Property(property="stage_code", type="integer", example=5001),
     *                 @OA\Property(property="diagnosed_date_time", type="string", example="2020-04-08 07:23:37"),
     *                 @OA\Property(property="location_logs", type="array",
     *                      @OA\Items(
     *                          @OA\Schema(
     *                              @OA\Property(property="date_time", type="string"),
     *                              @OA\Property(property="latitude", type="string"),
     *                              @OA\Property(property="longitude", type="string"),
     *                              @OA\Property(property="address", type="string"),
     *                          ),
     *                          example={
     *                              "date_time" : "2020-04-08 07:23:37",
     *                              "latitude" : "51.528308",
     *                              "longitude" : "-0.131847",
     *                              "address" : "8-14 Eversholt St, Kings Cross, London NW1 1DG, UK",
     *                          }
     *                      )
     *                 ),
     *                 @OA\Property(property="suspected_users_id", type="object", example={1, 2}),
     *             ),
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
    public function diseaseDiagnosed(PatientDiagnosedRequest $request)
    {
        $user = Auth::user();
        $disease_id = (int)$request->disease_code - 6000;
        $stage = (int)$request->stage_code - 5000;

        $match = UserDiagnosisLog::where([
            [ 'patient_id', '=', $user->id ],
            [ 'disease_id', '=', $disease_id ],
            [ 'stage', '=', $stage ],
        ])->first();

        if($match){
            return response()->json([
                'status' => ConstantHelper::STATUS_FORBIDDEN,
                'error' => [
                    'code' => 1001,
                    'message'=> 'Patient details with same disease and stage already exist in records'
                ],
            ], ConstantHelper::STATUS_FORBIDDEN);
        }

        $disease = Disease::find($disease_id);

        $diagnosis_log = new UserDiagnosisLog();
        $diagnosis_log->disease_id = $disease->id;
        $diagnosis_log->diagnosisDateTime = Carbon::parse($request->diagnosed_date_time)->format('Y-m-d H:i:s');
        $diagnosis_log->stage = $stage;
        $user->patients()->save($diagnosis_log);

        foreach ($request->location_logs as $location) {
            $location_log = new UserLocationLog();
            $location_log->dateTime = Carbon::parse($location['date_time'])->format('Y-m-d H:i:s');
            $location_log->latitude = $location['latitude'];
            $location_log->longitude = $location['longitude'];
            $location_log->address = $location['address'];
            $diagnosis_log->user_location_logs()->save($location_log);
        }

        // Send Push Message
        $messageTitle = 'Alert !! Be Cautious !!';
        $messageBody = 'You have been in-contact with a '. $disease->name .' Patient';
        $messageCustom = 'My custom data in extraPayLoad';

        $androidDeviceTokenArr = User::whereIn('id', $request->suspected_users_id)->whereNotNull('androidPushToken')->pluck('androidPushToken')->toArray();
        $iosDeviceTokenArr = User::whereIn('id', $request->suspected_users_id)->whereNotNull('iosPushToken')->pluck('iosPushToken')->toArray();
        // dd($androidDeviceTokenArr);
        // dd($iosDeviceTokenArr);

        // Android Push message
        if( count($androidDeviceTokenArr) > 0 ){
            $push = new PushNotification('fcm');
            $push->setMessage([
                    'notification' => [
                        'title' => $messageTitle,
                        'body' => $messageBody,
                        'sound' => 'default'
                    ],
                    'data' => [
                        'customPayLoad' => $messageCustom,
                    ]
            ])
            ->setApiKey( config('pushnotification.fcm')['apiKey'] )
            ->setDevicesToken($androidDeviceTokenArr)
            ->send();
            // dd($push->getFeedback());
        }

        // iOS Push message
        // if( count($iosDeviceTokenArr) > 0 ){
        //     $push = new PushNotification('apn');
        //     $push->setMessage([
        //             'aps' => [
        //                 'alert' => [
        //                     'title' => $messageTitle,
        //                     'body' => $messageBody
        //                 ],
        //                 'sound' => 'default',
        //                 'badge' => 1
        //             ],
        //             'extraPayLoad' => [
        //                 'customPayLoad' => $messageCustom,
        //             ]
        //         ])
        //     ->setDevicesToken($iosDeviceTokenArr)
        //     ->send();
        //     // dd($push->getFeedback());
        // }

        return response()->json([
            'status' => ConstantHelper::STATUS_OK,
            'message' => 'Diagnosed Patient details has been recorded successfully',
        ], ConstantHelper::STATUS_OK);
    }

    /**
     * @OA\Get(path="/patients",
     *   tags={"Map"},
     *   summary="List all patient details for map plotting",
     *   description="API to list all patient details for map plotting.",
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
    public function patients()
    {
        $dataArr = array();
        foreach (UserDiagnosisLog::all() as $diagnosis_log) {

            $stage = $diagnosis_log->stage;
            if( $stage != Disease::INFECTION_STATUS) continue;

            $innerArr = array();
            $innerArr = array(
                'user_uid' => $diagnosis_log->user->userCode,
                'disease_code' => (int)$diagnosis_log->disease_id + 6000,
                'stage_code' => (int)$stage + 5000,
                'diagnosed_date_time' => $diagnosis_log->diagnosisDateTime,
            );

            $recent_location_log = $diagnosis_log->user_location_logs()->latest('id')->first();
            $innerArr['location_logs'] = array(
                'date_time' => $recent_location_log->dateTime,
                'latitude' => $recent_location_log->latitude,
                'longitude' => $recent_location_log->longitude,
                'address' => $recent_location_log->address,
            );

            $dataArr[] = $innerArr;
        }

        if(count($dataArr) > 0){
            return response()->json([
                'status' => ConstantHelper::STATUS_OK,
                'message' => 'Patients List',
                'data' => $dataArr
            ], ConstantHelper::STATUS_OK);
        } else{
            return response()->json([
                'status' => ConstantHelper::STATUS_UNPROCESSABLE_ENTITY,
                'error' => [
                    'code' => 1004,
                    'message'=> 'No patient records to show'
                ],
            ], ConstantHelper::STATUS_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * @OA\Post(path="/user/updateLastLocation",
     *     tags={"Users"},
     *     summary="Update user's last known location",
     *     description="API to update user's last known location.",
     *     operationId="updateLastLocation",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(property="date_time", type="string"),
     *                 @OA\Property(property="latitude", type="string"),
     *                 @OA\Property(property="longitude", type="string"),
     *                 @OA\Property(property="address", type="string"),
     *                 example={
     *                     "date_time" : "2020-04-16 07:20:30",
     *                     "latitude": "51.528308",
     *                     "longitude": "-0.101847",
     *                     "address": "18 Northampton Square, Clerkenwell, London EC1V 0HB, UK",
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
    public function updateLastLocation(UserLocationRequest $request)
    {
        $diagnosis_logs = Auth::user()->patients()->get();
        if($diagnosis_logs->isNotEmpty())
        {
            foreach ($diagnosis_logs as $diagnosis_log){
                $location_log = new UserLocationLog();
                $location_log->dateTime = Carbon::parse($request->date_time)->format('Y-m-d H:i:s');
                $location_log->latitude = $request->latitude;
                $location_log->longitude = $request->longitude;
                $location_log->address = $request->address;
                $diagnosis_log->user_location_logs()->save($location_log);
            }
        }

        return response()->json([
            'status' => ConstantHelper::STATUS_OK,
            'message' => 'User\'s last location details has been recorded successfully',
        ], ConstantHelper::STATUS_OK);
    }
}