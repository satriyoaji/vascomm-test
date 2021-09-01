<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class SupervisionApproved extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($userJurnalName)
    {
        $this->userJurnalName = $userJurnalName;
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
                    ->subject(Lang::getFromJson('Selamat, Jurnal Anda Disetujui Supervisi!'))
                    ->greeting(Lang::getFromJson('Yth. Bapak/Ibu Pengelola Jurnal'))
                    ->line(Lang::getFromJson('Di tempat, '))
                    ->line(Lang::getFromJson('Dengan hormat,'))
                    ->line(Lang::getFromJson('Sebelumnya, terimakasih telah mengajukan supervisi jurnal di Relawan Jurnal Indonesia pada Program #1000jurnalterakreditasi 2021.'))
                    ->line(Lang::getFromJson('Saat ini, Status Jurnal Bapak/Ibu telah SELESAI disupervisi oleh supervisor kami.'))
                    ->line(Lang::getFromJson('Adapun info selanjutnya, Bapak/Ibu dapat memeriksa pengajuan supervisi secara berkala dan memberikan feedback/komentar sebagai tindak lanjut proses supervisi.'))
                    ->line(Lang::getFromJson('Berikut langkah-langkahnya:'))
                    ->line(Lang::getFromJson('1.	Login ke https://1000jurnalterakreditasi.id/  dengan username dan password yang telah diregistrasi sebelumnya'))
                    ->line(Lang::getFromJson('2.	Klik supervisi > klik proses'))
                    ->line(Lang::getFromJson('3.	Klik icon detail'))
                    ->line(Lang::getFromJson('4.	Klik icon testimoni, berikan feedback/komentar untuk supervisor'))
                    ->line(Lang::getFromJson('5.	Klik Submit'))
                    ->action('Login', url('/login'))
                    ->line(Lang::getFromJson('Dengan klik submit, maka proses supervisi telah selesai.'))
                    ->line(Lang::getFromJson('Kami mengucapkan terimakasih apabila Bapak/Ibu sudah memberikan feedback/komentar untuk supervisor.  '))
                    ->line(Lang::getFromJson('Informasi tambahan :'))
                    ->line(Lang::getFromJson('Bapak/ibu dapat berdonasi dengan cara membeli paket merchandise dari Relawan Jurnal Indonesia. Donasi dapat dilakukan melalui: '))
                    ->line(Lang::getFromJson('1.	Pilih tab Donasi '))
                    ->line(Lang::getFromJson('2.	Pilih paket yang dikehendaki'))
                    ->line(Lang::getFromJson('3.	Isikan jumlah dan alamat lengkap untuk pendataan di web'))
                    ->line(Lang::getFromJson('4.	Klik save changes.'))
                    ->line(Lang::getFromJson('Selanjutnya pembelian merchandise dilakukan melalui shopee '))
                    ->line(Lang::getFromJson('https://shopee.co.id/rji_store atau tokopedia '))
                    ->line(Lang::getFromJson('https://www.tokopedia.com/rjistore sesuai dengan pilihan paket merchandise yang terdapat di web.'))
                    ->line(Lang::getFromJson('Apabila terdapat kendala/saran/pertanyaan/ atau masukan, dapat Bapak/Ibu sampaikan melalui tab helpdesk atau email ini:  1000jurnal@relawanjurnal.id '))
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
