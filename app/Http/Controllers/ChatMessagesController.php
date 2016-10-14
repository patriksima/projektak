<?php

namespace App\Http\Controllers;

use App\ChatMessage;
use App\Events\Chat\MessageSent;
use App\Http\Requests;
use Illuminate\Http\Request;

class ChatMessagesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  string  $channel
     * @return \Illuminate\Http\Response
     */
    public function index($channel)
    {
        $messages = ChatMessage::with('sender')->where('channel', $channel)->limit(100)->get();

        return $messages;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = ChatMessage::send($request);

        event(new MessageSent($message));

        return 1;
    }
}
