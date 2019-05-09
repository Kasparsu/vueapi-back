<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Message;
use Illuminate\Http\Request;
use App\User;

class MessageController extends Controller
{
    public function send(Request $request)
    {
        $message = ['content' => $request->input('content')];
        $message += ['user' => \Auth::user()];
        broadcast(new NewMessage($message))->toOthers();
        return $message;
    }

}
