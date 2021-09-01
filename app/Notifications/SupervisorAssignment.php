<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class SupervisorAssignment extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($supervisorName)
    {
        $this->supervisorName = $supervisorName;
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
                    ->subject(Lang::getFromJson('Notifikasi Penugasan Supervisor'))
                    ->greeting(Lang::getFromJson('Yth. Bapak/Ibu Supervisor Program '. config('app.name')))
                    ->line(Lang::getFromJson('Anda telah ditugaskan oleh Admin untuk mensupervisi sebuah jurnal.'))
                    ->line(Lang::getFromJson('Silakan login ke aplikasi untuk informasi lebih lanjut.'))
                    ->action('Login', url('/login'))
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
