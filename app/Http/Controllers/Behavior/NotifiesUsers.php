<?php

namespace App\Http\Controllers\Behavior;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notification;

trait NotifiesUsers
{
    /**
     * Notifies given model.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function notify(Model $model, Notification $notification)
    {
        if (method_exists($model, 'notify')) {
            $model->notify($notification);
        }

        if ($user = $model->user) {
            $user->notify($notification);
        }
    }
}
