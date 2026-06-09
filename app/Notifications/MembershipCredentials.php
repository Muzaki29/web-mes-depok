<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MembershipCredentials extends Notification
{
    use Queueable;

    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public string $membershipNo,
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Akun Anggota MES Depok Anda Telah Dibuat')
            ->greeting('Assalamualaikum, ' . $this->name)
            ->line('Selamat! Pendaftaran keanggotaan Anda telah disetujui.')
            ->line('Berikut adalah kredensial akun Anda:')
            ->line('**Email:** ' . $this->email)
            ->line('**Password:** ' . $this->password)
            ->line('**No. Anggota:** ' . $this->membershipNo)
            ->action('Login ke Portal Anggota', url('/login'))
            ->line('Segera ubah password Anda setelah login pertama.')
            ->line('Terima kasih telah bergabung bersama MES Depok.');
    }
}
