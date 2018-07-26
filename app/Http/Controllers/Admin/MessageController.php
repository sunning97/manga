<?php

namespace App\Http\Controllers\Admin;

use App\Events\SendMessage;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view('admin.messages.index');
    }

    public function send(Request $request)
    {
        $message = new Message();
        $message->sent_to=$request->id;
        $message->sent_from=Auth::guard('admin')->user()->id;
        $message->content=$request->text;
        $message->save();

        broadcast(new SendMessage($message));

        return response()->json($message,200);
    }
}
