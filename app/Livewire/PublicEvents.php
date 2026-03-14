<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Event;
use App\Models\Partner;
use Livewire\WithPagination;

#[Layout('layouts.public')]
class PublicEvents extends Component
{
    use WithPagination;

    public $search = '';
    public $category = 'All';
    public $date_start = '';
    public $date_end = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedCategory()
    {
        $this->resetPage();
    }

    public function updatedDateStart()
    {
        $this->resetPage();
    }

    public function updatedDateEnd()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Event::where('is_public', true);

        if ($this->search) {
            $query->where(function($q) {
                $q->where('title', 'like', '%'.$this->search.'%')
                  ->orWhere('location', 'like', '%'.$this->search.'%')
                  ->orWhere('description', 'like', '%'.$this->search.'%');
            });
        }

        if ($this->category && $this->category !== 'All') {
            $query->where('category', $this->category);
        }

        if ($this->date_start) {
            $query->whereDate('start_at', '>=', $this->date_start);
        }
        
        if ($this->date_end) {
            $query->whereDate('end_at', '<=', $this->date_end);
        }

        $upcoming = (clone $query)->where('start_at', '>=', now())
            ->orderBy('start_at', 'asc')
            ->get();

        $past = (clone $query)->where('start_at', '<', now())
            ->orderBy('start_at', 'desc')
            ->paginate(6);

        // Stats could be dynamic or static as per requirement. 
        // For now, hardcoded as per reference, or we can count from DB if data exists.
        $stats = [
            'network' => 184,
            'activities' => Event::count(), // Example dynamic
            'beneficiaries' => 149135,
            'partners' => Partner::count() + 100 // Example
        ];

        return view('livewire.public-events', [
            'upcomingEvents' => $upcoming,
            'pastEvents' => $past,
            'stats' => $stats,
            'partners' => Partner::all()
        ]);
    }
}
