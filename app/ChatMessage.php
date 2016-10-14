<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ChatMessage extends Model
{
    /**
     * Fillable fields.
     *
     * @var array
     */
    protected $fillable = ['body'];

    /**
     * Specifies the belongs to relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Stores the message on the database
     *
     * @param  \Illuminate\Http\Request  $request
     * @return self
     */
    public static function send(Request $request)
    {
        $message = new static;

        $message->body = $request->body;
        $message->channel = $request->channel;
        $message->sender_id = auth('api')->user()->id;

        $message->save();

        return $message->load('sender');
    }
}
