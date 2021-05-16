<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Storage;

class NewContact extends Notification implements ShouldQueue
{
    use Queueable;

    private $data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
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

        if (isset($this->data['attachment'])) {

            $path = Storage::disk('local')->getAdapter()->getPathPrefix() . $this->data['attachment'];

            return (new MailMessage)
                ->subject('New Contact')
                ->attach($path,
                    [
                        'as' => $this->data['fileName'],
                        'mime' => Storage::disk('local')->mimeType($this->data['attachment']),
                    ])
                ->view('email.contact', $this->data);
        }

        return (new MailMessage)
            ->subject('New Contact')
            ->view('email.contact', $this->data);

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
