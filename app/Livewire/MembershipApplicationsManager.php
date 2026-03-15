<?php

namespace App\Livewire;

use App\Models\Member;
use App\Models\MembershipApplication;
use App\Notifications\MembershipApplicationStatusChanged;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Livewire\Component;

class MembershipApplicationsManager extends Component
{
    public string $search = '';

    public string $status = 'all';

    public int $perPage = 10;

    public bool $showReview = false;

    public ?int $reviewId = null;

    public array $form = ['notes' => ''];

    public function paginator(): LengthAwarePaginator
    {
        return MembershipApplication::query()
            ->when($this->status !== 'all', fn ($q) => $q->where('status', $this->status))
            ->when($this->search !== '', fn ($q) => $q->where('name', 'like', '%'.$this->search.'%')->orWhere('email', 'like', '%'.$this->search.'%'))
            ->orderByDesc('id')
            ->paginate($this->perPage, ['*'], 'page', request()->input('page', 1));
    }

    public function review(int $id): void
    {
        $this->reviewId = $id;
        $this->showReview = true;
    }

    public function approve(): void
    {
        $app = MembershipApplication::findOrFail($this->reviewId);
        $app->update(['status' => 'approved']);
        Member::create([
            'name' => $app->name,
            'membership_no' => 'MD-'.Str::upper(Str::random(8)),
            'status' => 'active',
        ]);
        Notification::route('mail', $app->email)->notify(new MembershipApplicationStatusChanged($app, 'Disetujui'));
        $this->showReview = false;
    }

    public function reject(): void
    {
        $app = MembershipApplication::findOrFail($this->reviewId);
        $app->update(['status' => 'rejected']);
        Notification::route('mail', $app->email)->notify(new MembershipApplicationStatusChanged($app, 'Ditolak'));
        $this->showReview = false;
    }

    public function render()
    {
        return view('livewire.membership-applications-manager', ['paginator' => $this->paginator()]);
    }
}
