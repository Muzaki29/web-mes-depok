<?php

namespace App\Livewire;

use App\Models\Letter;
use App\Models\LetterTemplate;
use App\Services\LetterNumberingService;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class LettersManager extends Component
{
    use WithPagination;

    public string $search = '';

    public int $perPage = 10;

    public $letters;

    public bool $showCreate = false;

    public bool $showEdit = false;

    public bool $showDelete = false;

    public ?int $editingId = null;

    public array $form = [
        'number' => '',
        'subject' => '',
        'direction' => 'outgoing',
        'template_id' => null,
    ];

    public function mount(): void
    {
        //
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedPerPage(): void
    {
        $this->resetPage();
    }

    #[On('openCreateLetter')]
    public function openCreateLetter(): void
    {
        $this->create();
    }

    protected function query()
    {
        return Letter::query()
            ->when($this->search !== '', function ($q) {
                $q->where(function ($sub) {
                    $s = '%'.$this->search.'%';
                    $sub->where('subject', 'like', $s)
                        ->orWhere('number', 'like', $s)
                        ->orWhere('direction', 'like', $s);
                });
            })->orderByDesc('id');
    }

    public function paginator(): LengthAwarePaginator
    {
        return $this->query()->paginate($this->perPage);
    }

    protected function closeModals(): void
    {
        $this->showCreate = false;
        $this->showEdit = false;
        $this->showDelete = false;
    }

    public function create(): void
    {
        $this->closeModals();
        $this->editingId = null;
        $this->form = ['number' => '', 'subject' => '', 'direction' => 'outgoing', 'template_id' => optional(LetterTemplate::first())->id];
        $this->showCreate = true;
    }

    public function store(): void
    {
        $data = $this->validate([
            'form.subject' => 'required|string|max:255',
            'form.direction' => 'required|in:incoming,outgoing',
            'form.template_id' => 'nullable|exists:letter_templates,id',
            'form.number' => 'nullable|string|max:255',
        ])['form'];

        if (empty($data['number']) && $data['direction'] === 'outgoing' && $data['template_id']) {
            $template = LetterTemplate::find($data['template_id']);
            $data['number'] = app(LetterNumberingService::class)->issueNumber($template);
        }

        Letter::create($data);
        $this->showCreate = false;
    }

    public function edit(int $id): void
    {
        $row = Letter::findOrFail($id);
        $this->closeModals();
        $this->editingId = $id;
        $this->form = [
            'number' => $row->number ?? '',
            'subject' => $row->subject ?? '',
            'direction' => $row->direction ?? 'outgoing',
            'template_id' => $row->template_id,
        ];
        $this->showEdit = true;
    }

    public function update(): void
    {
        $data = $this->validate([
            'form.subject' => 'required|string|max:255',
            'form.direction' => 'required|in:incoming,outgoing',
            'form.template_id' => 'nullable|exists:letter_templates,id',
            'form.number' => 'nullable|string|max:255',
        ])['form'];

        if (empty($data['number']) && $data['direction'] === 'outgoing' && $data['template_id']) {
            $template = LetterTemplate::find($data['template_id']);
            $data['number'] = app(LetterNumberingService::class)->issueNumber($template);
        }

        Letter::whereKey($this->editingId)->update($data);
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
        if ($letter = Letter::find($this->editingId)) {
            $letter->delete();
        }
        $this->showDelete = false;
    }

    public function render()
    {
        return view('livewire.letters-manager', ['paginator' => $this->paginator(), 'templates' => LetterTemplate::all()]);
    }
}
