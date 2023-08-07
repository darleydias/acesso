<?php

namespace App\Http\Controllers;

use App\Events\MessagePushed;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function message(Request $request)
    {
        event(new MessagePushed($request->get('message')));
        return response()->json([
            'message' => $request->get('message'),
        ]);
    }
}