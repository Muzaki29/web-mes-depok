<?php

namespace App\Livewire;

use App\Models\Consultation;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ConsultationsManager extends Component
{
    use WithPagination;

    public string $search = '';

    public string $status = 'all';

    public int $perPage = 10;

    public ?int $editingId = null;

    public bool $showCreate = false;

    public bool $showEdit = false;

    public bool $showDelete = false;

    public array $form = [
        'requester_name' => '',
        'topic' => '',
        'status' => 'submitted',
        'scheduled_at' => '',
    ];

    private function closeModals(): void
    {
        $this->showCreate = false;
        $this->showEdit = false;
        $this->showDelete = false;
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedStatus(): void
    {
        $this->resetPage();
    }

    public function getQuery()
    {
        return Consultation::query()
            ->when(trim($this->search) !== '', function ($q) {
                $s = '%'.trim($this->search).'%';
                $q->where(function ($sub) use ($s) {
                    $sub->where('requester_name', 'like', $s)
                        ->orWhere('topic', 'like', $s);
                });
            })
            ->when($this->status !== 'all', fn ($q) => $q->where('status', $this->status))
            ->orderByDesc('id');
    }

    public function render()
    {
        return view('livewire.consultations-manager', [
            'paginator' => $this->getQuery()->paginate($this->perPage),
        ]);
    }

    #[On('openCreateConsultation')]
    public function openCreateConsultation(): void
    {
        $this->create();
    }

    public function create(): void
    {
        $this->closeModals();
        $this->editingId = null;
        $this->form = [
            'requester_name' => '',
            'topic' => '',
            'status' => 'submitted',
            'scheduled_at' => '',
        ];
        $this->showCreate = true;
    }

    public function store(): void
    {
        if (($this->form['scheduled_at'] ?? null) === '') {
            $this->form['scheduled_at'] = null;
        }
        $data = $this->validate([
            'form.requester_name' => 'required|string|max:255',
            'form.topic' => 'required|string|max:255',
            'form.status' => 'required|in:submitted,assigned,scheduled,completed,cancelled',
            'form.scheduled_at' => 'nullable|date',
        ])['form'];

        Consultation::create([
            'requester_name' => $data['requester_name'],
            'topic' => $data['topic'],
            'status' => $data['status'],
            'scheduled_at' => $data['scheduled_at'] ?: null,
        ]);

        $this->showCreate = false;
    }

    public function edit(int $id): void
    {
        $this->closeModals();
        $this->editingId = $id;
        $row = Consultation::find($id);
        if (! $row) {
            return;
        }

        $this->form = [
            'requester_name' => $row->requester_name,
            'topic' => $row->topic,
            'status' => $row->status,
            'scheduled_at' => optional($row->scheduled_at)->format('Y-m-d\TH:i'),
        ];
        $this->showEdit = true;
    }

    public function update(): void
    {
        if (($this->form['scheduled_at'] ?? null) === '') {
            $this->form['scheduled_at'] = null;
        }
        $data = $this->validate([
            'form.requester_name' => 'required|string|max:255',
            'form.topic' => 'required|string|max:255',
            'form.status' => 'required|in:submitted,assigned,scheduled,completed,cancelled',
            'form.scheduled_at' => 'nullable|date',
        ])['form'];

        Consultation::whereKey($this->editingId)->update([
            'requester_name' => $data['requester_name'],
            'topic' => $data['topic'],
            'status' => $data['status'],
            'scheduled_at' => $data['scheduled_at'] ?: null,
        ]);

        $this->showEdit = false;
    }

    public function confirmDelete(int $id): void
    {
        $this->closeModals();
        $this->editingId = $id;
        $this->showDelete = true;
    }

    public function destroy(): void
    {
        Consultation::whereKey($this->editingId)->delete();
        $this->showDelete = false;
    }
}
