<?php

namespace App\Livewire;

use App\Models\Attendance;
use App\Models\Event;
use App\Models\EventRegistration;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class EventsManager extends Component
{
    use WithPagination;

    public string $search = '';

    public int $perPage = 10;

    public bool $showCreate = false;

    public bool $showEdit = false;

    public bool $showDelete = false;

    public bool $showParticipants = false;

    public ?int $editingId = null;

    public ?int $participantsEventId = null;

    public array $form = [
        'title' => '',
        'start_at' => '',
        'end_at' => '',
        'category' => '',
        'description' => '',
        'location' => '',
        'capacity' => 50,
        'is_public' => true,
    ];

    public function mount(): void {}

    #[On('openCreateEvent')]
    public function openCreateEvent(): void
    {
        $this->create();
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedPerPage(): void
    {
        $this->resetPage();
    }

    protected function closeModals(): void
    {
        $this->showCreate = false;
        $this->showEdit = false;
        $this->showDelete = false;
        $this->showParticipants = false;
    }

    public function create(): void
    {
        $this->closeModals();
        $this->editingId = null;
        $this->participantsEventId = null;
        $this->form = [
            'title' => '',
            'start_at' => now()->addWeek()->format('Y-m-d\TH:i'),
            'end_at' => '',
            'category' => '',
            'description' => '',
            'location' => '',
            'capacity' => 50,
            'is_public' => true,
        ];
        $this->showCreate = true;
    }

    public function store(): void
    {
        $data = $this->validate([
            'form.title' => 'required|string|max:255',
            'form.start_at' => 'required|date',
            'form.end_at' => 'nullable|date|after_or_equal:form.start_at',
            'form.category' => 'nullable|string|max:255',
            'form.description' => 'nullable|string',
            'form.location' => 'nullable|string|max:255',
            'form.capacity' => 'nullable|integer|min:1',
            'form.is_public' => 'boolean',
        ])['form'];

        if (($data['end_at'] ?? '') === '') {
            $data['end_at'] = null;
        }

        Event::create([
            'title' => $data['title'],
            'start_at' => $data['start_at'],
            'end_at' => $data['end_at'],
            'category' => $data['category'],
            'description' => $data['description'],
            'location' => $data['location'],
            'capacity' => $data['capacity'],
            'is_public' => (bool) ($data['is_public'] ?? true),
        ]);
        $this->showCreate = false;
    }

    public function edit(int $id): void
    {
        $row = Event::findOrFail($id);
        $this->closeModals();
        $this->editingId = $id;
        $this->participantsEventId = null;
        $this->form = [
            'title' => $row->title,
            'start_at' => optional($row->start_at)->format('Y-m-d\TH:i') ?? '',
            'end_at' => optional($row->end_at)->format('Y-m-d\TH:i') ?? '',
            'category' => $row->category ?? '',
            'description' => $row->description ?? '',
            'location' => $row->location ?? '',
            'capacity' => $row->capacity ?? 50,
            'is_public' => (bool) $row->is_public,
        ];
        $this->showEdit = true;
    }

    public function update(): void
    {
        $data = $this->validate([
            'form.title' => 'required|string|max:255',
            'form.start_at' => 'required|date',
            'form.end_at' => 'nullable|date|after_or_equal:form.start_at',
            'form.category' => 'nullable|string|max:255',
            'form.description' => 'nullable|string',
            'form.location' => 'nullable|string|max:255',
            'form.capacity' => 'nullable|integer|min:1',
            'form.is_public' => 'boolean',
        ])['form'];

        if (($data['end_at'] ?? '') === '') {
            $data['end_at'] = null;
        }

        Event::whereKey($this->editingId)->update([
            'title' => $data['title'],
            'start_at' => $data['start_at'],
            'end_at' => $data['end_at'],
            'category' => $data['category'],
            'description' => $data['description'],
            'location' => $data['location'],
            'capacity' => $data['capacity'],
            'is_public' => (bool) ($data['is_public'] ?? true),
        ]);

        $this->showEdit = false;
    }

    public function confirmDelete(int $id): void
    {
        $this->closeModals();
        $this->editingId = $id;
        $this->participantsEventId = null;
        $this->showDelete = true;
    }

    public function destroy(): void
    {
        Event::whereKey($this->editingId)->delete();
        $this->showDelete = false;
    }

    public function openParticipants(int $eventId): void
    {
        $this->closeModals();
        $this->participantsEventId = $eventId;
        $this->showParticipants = true;
    }

    public function toggleCheckIn(int $eventId, int $participantId): void
    {
        $reg = EventRegistration::whereKey($participantId)->where('event_id', $eventId)->first();
        if (! $reg instanceof EventRegistration) {
            return;
        }
        $att = Attendance::firstOrCreate(['event_id' => $eventId, 'registration_id' => $reg->id]);
        $att->checked_in_at = $att->checked_in_at ? null : now();
        $att->save();
    }

    protected function participants(): array
    {
        if (! $this->participantsEventId) {
            return [];
        }

        $rows = EventRegistration::query()
            ->where('event_id', $this->participantsEventId)
            ->orderBy('id')
            ->get(['id', 'event_id', 'name', 'email'])
            ->all();

        $ids = array_map(fn ($r) => $r->id, $rows);
        $checked = Attendance::query()
            ->where('event_id', $this->participantsEventId)
            ->whereIn('registration_id', $ids)
            ->whereNotNull('checked_in_at')
            ->pluck('registration_id')
            ->all();

        $checkedSet = array_fill_keys($checked, true);

        return array_map(function ($r) use ($checkedSet) {
            return [
                'id' => $r->id,
                'name' => $r->name,
                'email' => $r->email,
                'checked_in' => isset($checkedSet[$r->id]),
            ];
        }, $rows);
    }

    public function render()
    {
        return view('livewire.events-manager', [
            'paginator' => Event::query()
                ->when($this->search !== '', fn ($q) => $q->where('title', 'like', '%'.$this->search.'%'))
                ->orderByDesc('start_at')
                ->paginate($this->perPage),
            'participants' => $this->participants(),
            'participantsEventId' => $this->participantsEventId,
        ]);
    }
}
