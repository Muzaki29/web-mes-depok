<?php

namespace App\Notifications;

use App\Models\MembershipApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MembershipApplicationSubmitted extends Notification
{
    use Queueable;

    public function __construct(public MembershipApplication $application) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $a = $this->application;
        return (new MailMessage)
            ->subject('New Membership Application')
            ->greeting('Assalamu’alaikum, Admin')
            ->line('A new membership application has been submitted.')
            ->line('Name: '.$a->name)
            ->line('Email: '.$a->email)
            ->line('Phone: '.($a->phone ?: '—'))
            ->line('Organization: '.($a->organization ?: '—'))
            ->line('Notes: '.($a->notes ?: '—'))
            ->action('Open Admin Panel', url('/admin/members'))
            ->line('Please review this application in the admin dashboard.');
    }
}

