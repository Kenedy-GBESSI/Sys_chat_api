<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Message;
use App\Models\User;
use App\Events\NewChatMessage;

class ChatController extends Controller
{

   public function login(Request $request){
    $user= User::where('email', $request->email)->first();
    // print_r($data);
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => ['These credentials do not match our records.']
            ], 404);
        }

         $token = $user->createToken('my-app-token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

         return response($response, 201);
 }
    public function userConversations(){
        return Auth::user()->Conversations;
    }

    public function sendMessage(Request $request,$conversationId){
        $newMessage = new Message();
        $newMessage->content = $request->content;
        $newMessage->user_id = Auth::user()->id;
        $newMessage->conversation_id = $conversationId;
        $newMessage->save();
        broadcast(new NewChatMessage($newMessage))->toOthers();
        return $newMessage;;
    }

    public function messages($conversationId){
        return Message::where("conversation_id", $conversationId)
                    ->with("user")
                    ->orderBy('created_at','DESC')
                    ->get();
    }


}
