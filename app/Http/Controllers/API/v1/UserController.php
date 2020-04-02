<?php

namespace App\Http\Controllers\API\v1;

// use Illuminate\Http\Request;
use App\Http\Requests\API\LoginHandleRequest;
use App\Http\Controllers\Controller;

use Auth;
use Validator;
use Carbon\Carbon;
use ConstantHelper;

use App\Models\User;

class UserController extends Controller
{
    /**
     * @OA\Post(path="/login",
     *     tags={"Users"},
     *     summary="Check if a user is an existing or new one",
     *     description="API to check if a user is an existing or new one, using phone number.",
     *     operationId="login",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="phone_number",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="android_device_token",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="ios_device_token",
     *                     type="string",
     *                 ),
     *                 example={ "phone_number": "+919219592195", "android_device_token" : "", "ios_device_token" : "" },
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful Operation",
     *         @OA\JsonContent(),
     *         @OA\Header(
     *             header="Content-Type: application/json",
     *             @OA\Schema(
     *                 type="string",
     *             ),
     *             description="Content Type which needs to be added"
     *         ),
     *         @OA\Header(
     *             header="Authorization: Bearer <token>",
     *             @OA\Schema(
     *                 type="string",
     *             ),
     *             description="Authorization Token to be passed, generated duing /login API"
     *         ),
     *     )
     * )
     */
    public function login(LoginHandleRequest $request)
    {
        $user = User::where('phone', $request->phone_number)->first();
        if ($user){
            Auth::loginUsingId($user->id);
            $data['token'] = $user->createToken('eDemic Access Token')->accessToken;
            $data['user_id'] = $user->id;

            // $user->deviceToken = $request->device_token;
            // $user->save();

            return response()->json(['status' => true, 'message'=> 'You have successfully logged in', 'data'=> $data], ConstantHelper::STATUS_OK);
        } else{
            return response()->json(['status' => false, 'message'=> 'No such user match our records'], ConstantHelper::STATUS_UNAUTHORIZED);
        }
    }

}