<?php

namespace App\Livewire;

use App\Models\Document;
use App\Models\DocumentCategory;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class DocumentsManager extends Component
{
    use WithFileUploads, WithPagination;

    public string $search = '';

    public string $category = 'Semua';

    public int $perPage = 12;

    public bool $showCreate = false;

    public bool $showEdit = false;

    public bool $showDelete = false;

    public ?int $editingId = null;

    public array $form = [
        'title' => '',
        'category' => '',
        'visibility' => 'public',
        'role' => '',
    ];

    public $fileUpload;

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedCategory(): void
    {
        $this->resetPage();
    }

    public function getQuery()
    {
        return Document::query()
            ->with('category')
            ->when($this->category !== 'Semua', function ($q) {
                $q->whereHas('category', fn ($c) => $c->where('name', $this->category));
            })
            ->when(trim($this->search) !== '', function ($q) {
                $q->where('title', 'like', '%'.trim($this->search).'%');
            })
            ->orderByDesc('id');
    }

    public function paginator(): LengthAwarePaginator
    {
        return $this->getQuery()->paginate($this->perPage);
    }

    public function create(): void
    {
        $this->editingId = null;
        $this->form = [
            'title' => '',
            'category' => '',
            'visibility' => 'public',
            'role' => '',
        ];
        $this->reset('fileUpload');
        $this->showCreate = true;
    }

    public function store(): void
    {
        if (($this->form['role'] ?? null) === '') {
            $this->form['role'] = null;
        }

        $data = $this->validate([
            'form.title' => 'required|string|max:255',
            'form.category' => 'nullable|string|max:255',
            'form.visibility' => 'required|in:public,member,role,private',
            'form.role' => 'nullable|string|max:50|required_if:form.visibility,role',
            'fileUpload' => 'required|file|max:10240',
        ])['form'];

        $categoryId = null;
        $categoryName = trim((string) ($data['category'] ?? ''));
        if ($categoryName !== '') {
            $categoryId = DocumentCategory::firstOrCreate(['name' => $categoryName])->id;
        }

        $path = $this->fileUpload->store('documents', 'public');
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $slugBase = Str::slug($data['title']);
        if ($slugBase === '') {
            $slugBase = Str::slug(pathinfo($this->fileUpload->getClientOriginalName(), PATHINFO_FILENAME));
        }

        Document::create([
            'title' => $data['title'],
            'slug' => $slugBase.'-'.Str::random(6),
            'category_id' => $categoryId,
            'visibility' => $data['visibility'],
            'role' => $data['visibility'] === 'role' ? ($data['role'] ?? null) : null,
            'path' => $path,
            'mime' => $this->fileUpload->getMimeType(),
            'size' => $this->fileUpload->getSize(),
        ]);

        $this->showCreate = false;
        $this->reset('fileUpload');
    }

    public function edit(int $id): void
    {
        $doc = Document::with('category')->findOrFail($id);
        $this->editingId = $id;
        $this->form = [
            'title' => $doc->title,
            'category' => $doc->category->name ?? '',
            'visibility' => $doc->visibility,
            'role' => $doc->role ?? '',
        ];
        $this->reset('fileUpload');
        $this->showEdit = true;
    }

    public function update(): void
    {
        if (($this->form['role'] ?? null) === '') {
            $this->form['role'] = null;
        }

        $data = $this->validate([
            'form.title' => 'required|string|max:255',
            'form.category' => 'nullable|string|max:255',
            'form.visibility' => 'required|in:public,member,role,private',
            'form.role' => 'nullable|string|max:50|required_if:form.visibility,role',
            'fileUpload' => 'nullable|file|max:10240',
        ])['form'];

        $doc = Document::findOrFail($this->editingId);

        $categoryId = null;
        $categoryName = trim((string) ($data['category'] ?? ''));
        if ($categoryName !== '') {
            $categoryId = DocumentCategory::firstOrCreate(['name' => $categoryName])->id;
        }

        $payload = [
            'title' => $data['title'],
            'category_id' => $categoryId,
            'visibility' => $data['visibility'],
            'role' => $data['visibility'] === 'role' ? ($data['role'] ?? null) : null,
        ];

        if ($this->fileUpload) {
            $newPath = $this->fileUpload->store('documents', 'public');
            if ($doc->path) {
                Storage::disk('public')->delete($doc->path);
            }
            $payload['path'] = $newPath;
            $payload['mime'] = $this->fileUpload->getMimeType();
            $payload['size'] = $this->fileUpload->getSize();
        }

        $doc->update($payload);

        $this->showEdit = false;
        $this->reset('fileUpload');
    }

    public function confirmDelete(int $id): void
    {
        $this->editingId = $id;
        $this->showDelete = true;
    }

    public function destroy(): void
    {
        $doc = Document::find($this->editingId);
        if ($doc) {
            if ($doc->path) {
                Storage::disk('public')->delete($doc->path);
            }
            $doc->delete();
        }
        $this->showDelete = false;
    }

    public function render()
    {
        return view('livewire.documents-manager', [
            'paginator' => $this->paginator(),
            'categories' => array_merge(['Semua'], DocumentCategory::query()->pluck('name')->toArray()),
        ]);
    }
}
