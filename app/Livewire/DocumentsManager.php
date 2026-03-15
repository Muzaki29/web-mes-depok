<?php

namespace App\Livewire;

use App\Models\Document;
use App\Models\DocumentCategory;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class DocumentsManager extends Component
{
    use WithFileUploads;

    public string $search = '';

    public string $category = 'Semua';

    public $docs = [];

    public $upload;

    public function mount(): void
    {
        $this->refreshDocs();
    }

    public function getFiltered(): array
    {
        $query = Document::query()
            ->with('category')
            ->when($this->category !== 'Semua', function ($q) {
                $q->whereHas('category', fn ($c) => $c->where('name', $this->category));
            })
            ->when(trim($this->search) !== '', function ($q) {
                $q->where('title', 'like', '%'.$this->search.'%');
            })
            ->orderByDesc('id');

        return $query->get()->map(function ($d) {
            return [
                'id' => $d->id,
                'slug' => $d->slug,
                'title' => $d->title,
                'category' => $d->category->name ?? 'Tanpa Kategori',
                'path' => $d->path,
                'size' => $d->size ? number_format($d->size / 1024 / 1024, 2).' MB' : '—',
            ];
        })->toArray();
    }

    public function upload(): void
    {
        if (! $this->upload) {
            return;
        }
        $category = DocumentCategory::firstOrCreate(['name' => 'Uploads']);
        $path = $this->upload->store('documents', 'public');
        Document::create([
            'title' => $this->upload->getClientOriginalName(),
            'slug' => Str::slug(pathinfo($this->upload->getClientOriginalName(), PATHINFO_FILENAME)).'-'.Str::random(6),
            'category_id' => $category->id,
            'visibility' => 'member',
            'path' => $path,
            'mime' => $this->upload->getMimeType(),
            'size' => $this->upload->getSize(),
        ]);
        $this->refreshDocs();
        $this->reset('upload');
    }

    public function remove(int $id): void
    {
        if ($doc = Document::find($id)) {
            $doc->delete();
        }
        $this->refreshDocs();
    }

    public function render()
    {
        return view('livewire.documents-manager', [
            'items' => $this->getFiltered(),
            'categories' => array_merge(['Semua'], DocumentCategory::query()->pluck('name')->toArray()),
        ]);
    }

    protected function refreshDocs(): void
    {
        $this->docs = Document::orderByDesc('id')->get()->toArray();
    }
}
