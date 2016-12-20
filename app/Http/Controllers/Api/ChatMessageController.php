<?php

namespace App\Http\Controllers\Api;

use App\ChatMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChatMessageController extends Controller
{
    /**
     * Class constructor.
     *
     * @return void
     */
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
        return ChatMessage::send($request);
    }
}
