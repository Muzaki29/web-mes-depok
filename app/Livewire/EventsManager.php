<?php

namespace App\Livewire;

use App\Models\Attendance;
use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\On;
use Livewire\Component;

class EventsManager extends Component
{
    public string $search = '';

    public int $perPage = 10;

    public $events;

    public $participants = [];

    public bool $showCreate = false;

    public array $form = [
        'title' => '',
        'date' => '',
        'location' => '',
        'capacity' => 50,
    ];

    public function mount(): void {}

    #[On('openCreateEvent')]
    public function openCreateEvent(): void
    {
        $this->create();
    }

    public function getFiltered(): array
    {
        $q = Event::query()
            ->when($this->search !== '', fn ($query) => $query->where('title', 'like', '%'.$this->search.'%'))
            ->orderByDesc('start_at');

        return $q->get()->map(fn ($e) => [
            'id' => $e->id, 'title' => $e->title, 'date' => optional($e->start_at)->format('Y-m-d'), 'location' => $e->location, 'capacity' => $e->capacity,
        ])->toArray();
    }

    public function paginator(): LengthAwarePaginator
    {
        $data = $this->getFiltered();
        $page = request()->input('page', 1);
        $items = array_slice($data, ($page - 1) * $this->perPage, $this->perPage);

        return new LengthAwarePaginator($items, count($data), $this->perPage, $page, ['path' => request()->url(), 'query' => request()->query()]);
    }

    public function create(): void
    {
        $this->form = ['title' => '', 'date' => date('Y-m-d', strtotime('+1 week')), 'location' => '', 'capacity' => 50];
        $this->showCreate = true;
    }

    public function store(): void
    {
        $data = $this->validate([
            'form.title' => 'required|string|max:255',
            'form.date' => 'required|date',
            'form.location' => 'nullable|string|max:255',
            'form.capacity' => 'nullable|integer|min:1',
        ])['form'];
        Event::create([
            'title' => $data['title'],
            'start_at' => $data['date'],
            'location' => $data['location'],
            'capacity' => $data['capacity'],
        ]);
        $this->showCreate = false;
    }

    public function toggleCheckIn(int $eventId, int $participantId): void
    {
        $reg = EventRegistration::find($participantId);
        if (! $reg) {
            return;
        }
        $att = Attendance::firstOrCreate(['event_id' => $eventId, 'registration_id' => $reg->id]);
        $att->checked_in_at = $att->checked_in_at ? null : now();
        $att->save();
    }

    public function render()
    {
        $participants = [];
        foreach (Event::with('registrations')->get() as $e) {
            $participants[$e->id] = $e->registrations->map(function ($r) {
                $checked = Attendance::where('registration_id', $r->id)->where('event_id', $r->event_id)->whereNotNull('checked_in_at')->exists();

                return ['id' => $r->id, 'name' => $r->name, 'checked_in' => $checked];
            })->toArray();
        }
        $this->participants = $participants;

        return view('livewire.events-manager', ['paginator' => $this->paginator()]);
    }
}
