<?php

namespace App\Livewire;

use App\Models\User;
use App\Notifications\BroadcastDatabaseNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Schema;
use Livewire\Component;

class NotificationsSender extends Component
{
    public array $form = [
        'audience' => 'members',
        'email' => '',
        'title' => '',
        'body' => '',
        'url' => '',
    ];

    public function resetForm(): void
    {
        $this->form = [
            'audience' => 'members',
            'email' => '',
            'title' => '',
            'body' => '',
            'url' => '',
        ];
        $this->resetErrorBag();
    }

    public function send(): void
    {
        if (! Schema::hasTable('notifications')) {
            session()->flash('status', 'Fitur notifikasi belum aktif. Jalankan migrasi terlebih dahulu.');

            return;
        }

        $validUrl = function (?string $value): bool {
            if ($value === null || trim($value) === '') {
                return true;
            }

            $value = trim($value);
            if (str_starts_with($value, '/')) {
                return true;
            }

            return filter_var($value, FILTER_VALIDATE_URL) !== false;
        };

        $data = $this->validate([
            'form.audience' => 'required|in:all,members,admins,email',
            'form.email' => 'nullable|email|max:255',
            'form.title' => 'required|string|max:150',
            'form.body' => 'nullable|string|max:1500',
            'form.url' => ['nullable', 'string', 'max:500', function ($attribute, $value, $fail) use ($validUrl) {
                if (! $validUrl($value)) {
                    $fail('URL tidak valid.');
                }
            }],
        ])['form'];

        if (($data['audience'] ?? '') === 'email' && trim((string) ($data['email'] ?? '')) === '') {
            $this->addError('form.email', 'Email wajib diisi.');

            return;
        }

        $title = $data['title'];
        $body = ($data['body'] ?? '') !== '' ? $data['body'] : null;
        $url = ($data['url'] ?? '') !== '' ? $data['url'] : null;

        $query = User::query()->orderBy('id');
        if ($data['audience'] === 'members') {
            $query->where('role', 'member');
        } elseif ($data['audience'] === 'admins') {
            $query->whereIn('role', ['super_admin', 'org_admin']);
        } elseif ($data['audience'] === 'email') {
            $query->where('email', $data['email']);
        }

        $query->chunk(500, function ($users) use ($title, $body, $url) {
            Notification::send($users, new BroadcastDatabaseNotification($title, $body, $url));
        });

        $this->form = ['audience' => $data['audience'], 'email' => '', 'title' => '', 'body' => '', 'url' => ''];
        session()->flash('status', 'Notifikasi berhasil dikirim.');
    }

    public function render()
    {
        return view('livewire.notifications-sender');
    }
}
