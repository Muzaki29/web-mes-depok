<?php

namespace App\Notifications;

use App\Models\MembershipApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MembershipApplicationStatusChanged extends Notification
{
    use Queueable;

    public function __construct(public MembershipApplication $application, public string $status)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Status Pendaftaran Keanggotaan MES Depok')
            ->greeting('Assalamualaikum, '.$this->application->name)
            ->line('Status pendaftaran Anda: '.$this->status)
            ->line('Terima kasih atas ketertarikan Anda bergabung bersama MES Depok.');
    }
}

