<?php

namespace App\Livewire;

use App\Models\Letter;
use App\Models\LetterTemplate;
use App\Services\LetterNumberingService;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\On;
use Livewire\Component;

class LettersManager extends Component
{
    public string $search = '';

    public int $perPage = 10;

    public $letters;

    public bool $showCreate = false;

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

    public function create(): void
    {
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

    public function confirmDelete(int $id): void
    {
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
