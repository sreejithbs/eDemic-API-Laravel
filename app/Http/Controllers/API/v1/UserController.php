<?php

namespace App\Http\Controllers\API\v1;

// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use ConstantHelper;

use App\Models\Message;

class UserController extends Controller
{
    /**
    * @OA\Get(path="/user/messages/{index}",
    *   tags={"Users"},
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
        $messages = Message::where('isPosted', 1)
                ->latest('id')
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
}