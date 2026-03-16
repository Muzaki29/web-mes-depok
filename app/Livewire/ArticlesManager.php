<?php

namespace App\Livewire;

use App\Models\Article;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ArticlesManager extends Component
{
    use WithFileUploads;

    public string $search = '';

    public int $perPage = 10;

    public bool $showCreate = false;

    public bool $showEdit = false;

    public bool $showDelete = false;

    public ?int $editingId = null;

    public array $form = [
        'title' => '',
        'excerpt' => '',
        'body' => '',
        'status' => 'draft',
        'published_at' => '',
    ];

    public $thumbnailUpload;

    public function paginator(): LengthAwarePaginator
    {
        return Article::query()
            ->when($this->search !== '', fn ($q) => $q->where('title', 'like', '%'.$this->search.'%'))
            ->orderByDesc('id')
            ->paginate($this->perPage, ['*'], 'page', request()->input('page', 1));
    }

    public function create(): void
    {
        $this->form = ['title' => '', 'excerpt' => '', 'body' => '', 'status' => 'draft', 'published_at' => ''];
        $this->showCreate = true;
    }

    public function store(): void
    {
        if (($this->form['published_at'] ?? null) === '') {
            $this->form['published_at'] = null;
        }
        $data = $this->validate([
            'form.title' => 'required|string|max:255',
            'form.excerpt' => 'nullable|string|max:500',
            'form.body' => 'nullable|string',
            'form.status' => 'required|in:draft,published',
            'form.published_at' => 'nullable|date',
            'thumbnailUpload' => 'nullable|image|max:2048',
        ])['form'];
        $upload = $this->thumbnailUpload;
        $data['author_id'] = Auth::id();
        if ($upload) {
            $path = $upload->store('articles', 'public');
            $stored = $path;
            try {
                if (function_exists('imagewebp')) {
                    $raw = Storage::disk('public')->get($path);
                    $img = @imagecreatefromstring($raw);
                    if ($img) {
                        $webpPath = preg_replace('/\\.[^.]+$/', '.webp', $path);
                        imagewebp($img, Storage::disk('public')->path($webpPath), 80);
                        imagedestroy($img);
                        $stored = $webpPath;
                    }
                }
            } catch (\Throwable $e) {
            }
            $data['thumbnail'] = $stored;
        }
        Article::create($data);
        $this->showCreate = false;
        $this->reset('thumbnailUpload');
    }

    public function edit(int $id): void
    {
        $row = Article::findOrFail($id);
        $this->editingId = $id;
        $this->form = [
            'title' => $row->title,
            'excerpt' => $row->excerpt,
            'body' => $row->body,
            'status' => $row->status,
            'published_at' => optional($row->published_at)->format('Y-m-d\TH:i'),
        ];
        $this->showEdit = true;
    }

    public function update(): void
    {
        if (($this->form['published_at'] ?? null) === '') {
            $this->form['published_at'] = null;
        }
        $data = $this->validate([
            'form.title' => 'required|string|max:255',
            'form.excerpt' => 'nullable|string|max:500',
            'form.body' => 'nullable|string',
            'form.status' => 'required|in:draft,published',
            'form.published_at' => 'nullable|date',
            'thumbnailUpload' => 'nullable|image|max:2048',
        ])['form'];
        $upload = $this->thumbnailUpload;
        if ($upload) {
            $path = $upload->store('articles', 'public');
            $stored = $path;
            try {
                if (function_exists('imagewebp')) {
                    $raw = Storage::disk('public')->get($path);
                    $img = @imagecreatefromstring($raw);
                    if ($img) {
                        $webpPath = preg_replace('/\\.[^.]+$/', '.webp', $path);
                        imagewebp($img, Storage::disk('public')->path($webpPath), 80);
                        imagedestroy($img);
                        $stored = $webpPath;
                    }
                }
            } catch (\Throwable $e) {
            }
            $data['thumbnail'] = $stored;
        }
        Article::whereKey($this->editingId)->update($data);
        $this->showEdit = false;
        $this->reset('thumbnailUpload');
    }

    public function confirmDelete(int $id): void
    {
        $this->editingId = $id;
        $this->showDelete = true;
    }

    public function destroy(): void
    {
        Article::whereKey($this->editingId)->delete();
        $this->showDelete = false;
    }

    public function render()
    {
        return view('livewire.articles-manager', ['paginator' => $this->paginator()]);
    }
}
