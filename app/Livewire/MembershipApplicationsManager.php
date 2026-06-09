<?php

namespace App\Livewire;

use App\Models\Member;
use App\Models\MembershipApplication;
use App\Models\User;
use App\Notifications\MembershipApplicationStatusChanged;
use App\Notifications\MembershipCredentials;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class MembershipApplicationsManager extends Component
{
    use WithPagination;

    public string $search = '';

    public string $status = 'all';

    public int $perPage = 10;

    public bool $showReview = false;

    public ?int $reviewId = null;

    public array $form = ['notes' => ''];

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedStatus(): void
    {
        $this->resetPage();
    }

    public function updatedPerPage(): void
    {
        $this->resetPage();
    }

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
        $this->showReview = false;
        $this->reviewId = $id;
        $this->showReview = true;
    }

    public function approve(): void
    {
        $app = MembershipApplication::findOrFail($this->reviewId);
        $app->update(['status' => 'approved']);

        // Find or create user account
        $user = User::where('email', $app->email)->first();
        $plainPassword = null;

        if (! $user) {
            $plainPassword = Str::random(10);
            $user = User::create([
                'name' => $app->name,
                'email' => $app->email,
                'password' => Hash::make($plainPassword),
                'role' => 'member',
                'phone' => $app->phone,
                'organization' => $app->organization,
            ]);
        } else {
            $user->update(['role' => 'member']);
        }

        // Create member record linked to user
        $membershipNo = 'MD-' . Str::upper(Str::random(8));
        Member::create([
            'user_id' => $user->id,
            'name' => $app->name,
            'membership_no' => $membershipNo,
            'status' => 'active',
            'valid_until' => now()->addYear(),
        ]);

        // Send appropriate notification
        if ($plainPassword) {
            // New user — send credentials
            $user->notify(new MembershipCredentials($app->name, $app->email, $plainPassword, $membershipNo));
        } else {
            // Existing user — send approval notice
            Notification::route('mail', $app->email)->notify(new MembershipApplicationStatusChanged($app, 'Disetujui'));
        }

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
