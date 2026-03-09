<?php

namespace App\Livewire;

use App\Models\Announcement;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;

class AnnouncementsManager extends Component
{
    public string $search = '';
    public int $perPage = 10;
    public bool $showCreate = false;
    public bool $showEdit = false;
    public bool $showDelete = false;
    public ?int $editingId = null;
    public array $form = [
        'title' => '',
        'body' => '',
        'status' => 'draft',
        'published_at' => '',
    ];

    public function paginator(): LengthAwarePaginator
    {
        return Announcement::query()
            ->when($this->search !== '', fn ($q) => $q->where('title','like','%'.$this->search.'%'))
            ->orderByDesc('id')
            ->paginate($this->perPage, ['*'], 'page', request()->input('page', 1));
    }

    public function create(): void
    {
        $this->form = ['title'=>'','body'=>'','status'=>'draft','published_at'=>''];
        $this->showCreate = true;
    }

    public function store(): void
    {
        $data = $this->validate([
            'form.title' => 'required|string|max:255',
            'form.body' => 'nullable|string',
            'form.status' => 'required|in:draft,published',
            'form.published_at' => 'nullable|date',
        ])['form'];
        Announcement::create($data);
        $this->showCreate = false;
    }

    public function edit(int $id): void
    {
        $row = Announcement::findOrFail($id);
        $this->editingId = $id;
        $this->form = [
            'title' => $row->title,
            'body' => $row->body,
            'status' => $row->status,
            'published_at' => optional($row->published_at)->format('Y-m-d\TH:i'),
        ];
        $this->showEdit = true;
    }

    public function update(): void
    {
        $data = $this->validate([
            'form.title' => 'required|string|max:255',
            'form.body' => 'nullable|string',
            'form.status' => 'required|in:draft,published',
            'form.published_at' => 'nullable|date',
        ])['form'];
        Announcement::whereKey($this->editingId)->update($data);
        $this->showEdit = false;
    }

    public function confirmDelete(int $id): void
    {
        $this->editingId = $id;
        $this->showDelete = true;
    }

    public function destroy(): void
    {
        Announcement::whereKey($this->editingId)->delete();
        $this->showDelete = false;
    }

    public function render()
    {
        return view('livewire.announcements-manager', ['paginator'=>$this->paginator()]);
    }
}
