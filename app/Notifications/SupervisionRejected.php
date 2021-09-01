<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class SupervisionRejected extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($userName, $rejectMessage)
    {
        $this->userName = $userName;
        $this->rejectMessage = $rejectMessage;
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
        return (new MailMessage)
                    ->subject(Lang::getFromJson('Notifikasi Penolakan Supervisi'))
                    ->greeting(Lang::getFromJson('Yth. Bapak/Ibu Pengelola Jurnal'))
                    ->line(Lang::getFromJson('Jurnal Anda tidak disetujui supervisi oleh supervisor, dengan pesan :'))
                    ->line(Lang::getFromJson('"' . $this->rejectMessage . '"'))
                    ->line(Lang::getFromJson('Terimakasih atas kerjasamanya, dan salam publikasi,'));
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
