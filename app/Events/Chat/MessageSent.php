<?php

namespace App\Events\Chat;

use App\ChatMessage;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    /**
     * @var \App\ChatMessage
     */
    public $message;

    /**
     * @var \App\User
     */
    public $sender;

    /**
     * Create a new event instance.
     *
     * @param  \App\ChatMessage  $message
     * @return void
     */
    public function __construct(ChatMessage $message)
    {
        $this->dontBroadcastToCurrentUser();

        $this->message = $message;

        // We have to specify the sender explicitly
        // since Laravel doesn't retain the relationship
        // when serializing the data for broadcasting.
        $this->sender = $message->sender;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return [$this->message->channel];
    }
}
