<?php

namespace App\Livewire;

use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Schema;
use Livewire\Component;
use Livewire\WithPagination;

class NotificationsCenter extends Component
{
    use WithPagination;

    public int $perPage = 15;

    public function paginator()
    {
        if (! Schema::hasTable('notifications')) {
            return collect();
        }

        return auth()->user()
            ->notifications()
            ->latest()
            ->paginate($this->perPage, ['*'], 'page', request()->input('page', 1));
    }

    public function markRead(string $id): void
    {
        if (! Schema::hasTable('notifications')) {
            return;
        }

        $n = auth()->user()->notifications()->whereKey($id)->first();
        if (! ($n instanceof DatabaseNotification)) {
            return;
        }

        $n->markAsRead();
    }

    public function markAllRead(): void
    {
        if (! Schema::hasTable('notifications')) {
            return;
        }

        auth()->user()->unreadNotifications()->update(['read_at' => now()]);
    }

    public function render()
    {
        return view('livewire.notifications-center', [
            'rows' => $this->paginator(),
        ]);
    }
}
