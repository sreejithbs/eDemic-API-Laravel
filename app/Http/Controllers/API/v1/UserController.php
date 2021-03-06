<?php

namespace App\Http\Controllers\API\v1;

// use Illuminate\Http\Request;
use App\Http\Requests\API\DeviceTokenRequest;
use App\Http\Requests\API\QuarantineUserRequest;
use App\Http\Requests\API\DiseaseQRCodeRequest;
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
use App\Models\QuarantineLog;

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
    *       {"Bearer_Token_Auth": {}}
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
     *          {"Bearer_Token_Auth": {}}
     *     },
     * )
     */
    public function updateDeviceToken(DeviceTokenRequest $request)
    {
        $user = Auth::user();
        if($request->has('android_device_token')){
            $user->androidPushToken = $request->android_device_token;
            $user->iosPushToken = null;
            $user->iosDeviceId = null;
        } else{
            $user->iosPushToken = $request->ios_device_token;
            $user->androidPushToken = null;
            $user->androidDeviceId = null;
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
    *       {"Bearer_Token_Auth": {}}
    *   },
    * )
    */
    public function fetchDoctorProfile($doctor_id)
    {
        $user = Auth::user();

        $doctor = DoctorProfile::find($doctor_id);
        if( $doctor )
        {
            if( $user->is_doctor_id )
            {
                if($user->is_doctor_id == $doctor->id)
                {
                    $data['id'] = $doctor->id;
                    $data['name'] = $doctor->name;
                    $data['health_institution'] = $doctor->health_institution->name;

                    return response()->json([
                        'status' => ConstantHelper::STATUS_OK,
                        'message' => 'Doctor Profile',
                        'data' => $data
                    ], ConstantHelper::STATUS_OK);
                }
                else {
                    return response()->json([
                        'status' => ConstantHelper::STATUS_FORBIDDEN,
                        'error' => [
                            'code' => 1001,
                            'message'=> 'User account is already mapped to another Doctor Profile.'
                        ],
                    ], ConstantHelper::STATUS_FORBIDDEN);
                }
            }
            else if( $doctor->user()->exists() ) {
                return response()->json([
                    'status' => ConstantHelper::STATUS_FORBIDDEN,
                    'error' => [
                        'code' => 1001,
                        'message'=> 'Doctor Profile is already mapped to another user account.'
                    ],
                ], ConstantHelper::STATUS_FORBIDDEN);
            }
            else {
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
        }
        else {
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
    *       {"Bearer_Token_Auth": {}}
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
     * @OA\Post(path="/user/diseaseQRCodeScanned",
     *     tags={"Users"},
     *     summary="Submit disease QR code scanned user details",
     *     description="API to submit disease QR code scanned user details to be saved in database.",
     *     operationId="diseaseQRCodeScanned",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(property="disease_code", type="integer", example=6001),
     *                 @OA\Property(property="stage_code", type="integer", example=5001),
     *                 @OA\Property(property="scan_date_time", type="string", example="2020-04-08 07:23:37"),
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
     *          {"Bearer_Token_Auth": {}}
     *     },
     * )
     */
    public function diseaseQRCodeScanned(DiseaseQRCodeRequest $request)
    {
        $user = Auth::user();
        $disease_id = (int)$request->disease_code - 6000;
        $stage = (int)$request->stage_code - 5000;

        // Fetch last similar entry
        $check_diagnosis_log = UserDiagnosisLog::where([
            [ 'patient_id', '=', $user->id ],
            [ 'disease_id', '=', $disease_id ],
        ])->latest('id')->first();

        if($check_diagnosis_log){
            $existingStage = $check_diagnosis_log->stage;
            if( $existingStage == $stage )
            {
                if($existingStage == Disease::SELF_QUARANTINE_STATUS){
                    $msg = 'Self-Quaratine details for same disease already exists in records';
                } else{
                    $msg = 'Patient details with same disease and stage already exist in records';
                }

                return response()->json([
                    'status' => ConstantHelper::STATUS_FORBIDDEN,
                    'error' => [
                        'code' => 1001,
                        'message'=> $msg
                    ],
                ], ConstantHelper::STATUS_FORBIDDEN);
            }
            else {

                // NEW STAGE           PERMITTED EXISTING STAGE/S

                // Infection       :   Recovered, Self Quarantine
                // Recovered       :   Infection, Self Quarantine
                // Dead            :   Infection, Self Quarantine
                // Self Quarantine :   Recovered

                if( $stage == Disease::INFECTION_STATUS && in_array($existingStage, [Disease::RECOVERED_STATUS, Disease::SELF_QUARANTINE_STATUS]) ) {
                    //
                } else if( $stage == Disease::RECOVERED_STATUS && in_array($existingStage, [Disease::INFECTION_STATUS, Disease::SELF_QUARANTINE_STATUS]) ) {
                    //
                } else if( $stage == Disease::DEAD_STATUS && in_array($existingStage, [Disease::INFECTION_STATUS, Disease::SELF_QUARANTINE_STATUS]) ) {
                    //
                } else if( $stage == Disease::SELF_QUARANTINE_STATUS && $existingStage == Disease::RECOVERED_STATUS) {
                    //
                } else {

                    if($existingStage == Disease::SELF_QUARANTINE_STATUS){
                        $msg = 'Updating existing Self-Quaratine details with provided disease stage failed';
                    } else{
                        $msg = 'Updating existing Patient details with provided disease stage failed';
                    }

                    return response()->json([
                        'status' => ConstantHelper::STATUS_FORBIDDEN,
                        'error' => [
                            'code' => 1001,
                            'message'=> $msg
                        ],
                    ], ConstantHelper::STATUS_FORBIDDEN);
                }
            }
        }

        $disease = Disease::find($disease_id);

        $diagnosis_log = new UserDiagnosisLog();
        $diagnosis_log->disease_id = $disease->id;
        $diagnosis_log->diagnosisDateTime = Carbon::parse($request->scan_date_time)->format('Y-m-d H:i:s');
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

        if($stage == Disease::SELF_QUARANTINE_STATUS)
        {
            return response()->json([
                'status' => ConstantHelper::STATUS_OK,
                'message' => 'Quarantined User details has been recorded successfully',
            ], ConstantHelper::STATUS_OK);
        }
        else {
            // // Delete User's self quarantine log, if exists
            // if($quarantine = $user->quarantine){
            //     $quarantine->delete();
            // }

            // Send Proximity Alert Push Message
            $messageTitle = 'Alert !! Be Cautious !!';
            $messageBody = 'You have been in-contact with a '. $disease->name .' Patient';
            $messageCustom = 'My custom data in extraPayLoad';

            $androidDeviceTokenArr = User::whereIn('id', $request->suspected_users_id)->whereNotNull('androidPushToken')->pluck('androidPushToken')->toArray();
            $iosDeviceTokenArr = User::whereIn('id', $request->suspected_users_id)->whereNotNull('iosPushToken')->pluck('iosPushToken')->toArray();

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
                'message' => 'Patient details has been recorded successfully',
            ], ConstantHelper::STATUS_OK);
        }
    }

    /**
     * @OA\Post(path="/user/setQuarantineLocation",
     *     tags={"Users"},
     *     summary="Set/update user's quarantine location details",
     *     description="API to set/update user's quarantine location details to be saved in database.",
     *     operationId="setQuarantineLocation",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(property="date_time", type="string", example="2020-04-08 07:23:37"),
     *                 @OA\Property(property="latitude", type="string", example="51.528308"),
     *                 @OA\Property(property="longitude", type="string", example="-0.131847"),
     *                 @OA\Property(property="address", type="string", example="9-14 Eversholt St, Kings Cross, London NW1 1DG, UK"),
     *             ),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful Operation",
     *         @OA\JsonContent()
     *     ),
     *     security={
     *          {"Bearer_Token_Auth": {}}
     *     },
     * )
     */
    public function setQuarantineLocation(QuarantineUserRequest $request)
    {
        $user = Auth::user();
        $quarantine_log = $user->quarantine;
        if($quarantine_log)
        {
            $quarantine_log->update([
                'dateTime' => Carbon::parse($request->date_time)->format('Y-m-d H:i:s'),
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'address' => $request->address,
            ]);
        }
        else
        {
            $quarantine_log = new QuarantineLog();
            $quarantine_log->dateTime = Carbon::parse($request->date_time)->format('Y-m-d H:i:s');
            $quarantine_log->latitude = $request->latitude;
            $quarantine_log->longitude = $request->longitude;
            $quarantine_log->address = $request->address;
            $user->quarantine()->save($quarantine_log);
        }

        return response()->json([
            'status' => ConstantHelper::STATUS_OK,
            'message' => 'Quarantine Location details has been recorded successfully',
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
     *       {"Bearer_Token_Auth": {}}
     *   },
     * )
     */
    public function patients()
    {
        $dataArr = array();
        $diagnosis_logs = UserDiagnosisLog::whereRaw('id IN (SELECT MAX(id) FROM user_diagnosis_logs GROUP BY patient_id, disease_id)')
                            ->where('stage', Disease::INFECTION_STATUS)
                            ->has('user_location_logs')
                            ->with(['user_location_logs'])
                            ->latest('id')
                            ->get();

        foreach ($diagnosis_logs as $diagnosis_log) {

            $stage = $diagnosis_log->stage;

            $innerArr = array();
            $innerArr = array(
                'user_uid' => $diagnosis_log->user->userCode,
                'disease_code' => (int)$diagnosis_log->disease_id + 6000,
                'risk_level_code' => (int)$diagnosis_log->disease->riskLevel + 3000,
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
     *          {"Bearer_Token_Auth": {}}
     *     },
     * )
     */
    public function updateLastLocation(UserLocationRequest $request)
    {
        $diagnosis_logs = UserDiagnosisLog::whereRaw('id IN (SELECT MAX(id) FROM user_diagnosis_logs GROUP BY patient_id, disease_id)')
                            ->where('patient_id', Auth::id())
                            // ->where('stage', Disease::INFECTION_STATUS)
                            ->has('user_location_logs')
                            ->with(['user_location_logs'])
                            ->latest('id')
                            ->get();

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

            return response()->json([
                'status' => ConstantHelper::STATUS_OK,
                'message' => 'User\'s last location details has been recorded successfully',
            ], ConstantHelper::STATUS_OK);
        }
        else {
            return response()->json([
                'status' => ConstantHelper::STATUS_FORBIDDEN,
                'error' => [
                    'code' => 1001,
                    'message'=> 'No matching patient record exists for corresponding user'
                ],
            ], ConstantHelper::STATUS_FORBIDDEN);
        }
    }
}