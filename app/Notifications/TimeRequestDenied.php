<?php

namespace App\Notifications;

use App\TaskRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class TimeRequestDenied extends Notification
{
    use Queueable;

    /**
     * Task request that has been updated.
     *
     * @var \App\TaskRequest
     */
    protected $request;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(TaskRequest $request)
    {
        $this->request = $request;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = url('/tasks/'.$this->request->task->id);

        return (new MailMessage)
            ->error()
            ->subject('Your time request has been denied')
            ->greeting('Hello, '.$this->request->worker->name)
            ->line('Your time request for the task '.$this->request->task->name.'has been denied.')
            ->action('View Task', $url);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
