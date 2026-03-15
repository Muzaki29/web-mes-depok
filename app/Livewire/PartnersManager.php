<?php

namespace App\Livewire;

use App\Models\Partner;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class PartnersManager extends Component
{
    use WithFileUploads;

    public string $search = '';

    public int $perPage = 10;

    public $partners;

    public bool $showCreate = false;

    public bool $showEdit = false;

    public bool $showDelete = false;

    public ?int $editingId = null;

    public $logoUpload;

    public array $form = [
        'name' => '',
        'type' => 'company',
        'website' => '',
        'logo' => null,
    ];

    public function mount(): void {}

    #[On('openCreatePartner')]
    public function openCreatePartner(): void
    {
        $this->create();
    }

    protected function filtered(): array
    {
        $query = Partner::query()
            ->when($this->search !== '', function ($q) {
                $s = '%'.$this->search.'%';
                $q->where(function ($sub) use ($s) {
                    $sub->where('name', 'like', $s)
                        ->orWhere('type', 'like', $s)
                        ->orWhere('website', 'like', $s);
                });
            })
            ->orderBy('name');

        return $query->get()->toArray();
    }

    public function paginator(): LengthAwarePaginator
    {
        $data = $this->filtered();
        $page = request()->input('page', 1);
        $items = array_slice($data, ($page - 1) * $this->perPage, $this->perPage);

        return new LengthAwarePaginator($items, count($data), $this->perPage, $page, ['path' => request()->url(), 'query' => request()->query()]);
    }

    public function create(): void
    {
        $this->form = ['name' => '', 'type' => 'company', 'website' => '', 'logo' => null];
        $this->reset('logoUpload');
        $this->showCreate = true;
    }

    public function store(): void
    {
        $data = $this->validate([
            'form.name' => 'required|string|max:255',
            'form.type' => 'required|in:ngo,company,gov,edu,other',
            'form.website' => 'nullable|string|max:255',
            'logoUpload' => 'nullable|image|max:2048',
        ])['form'];
        if ($this->logoUpload) {
            $data['logo'] = $this->logoUpload->store('partners', 'public');
        }
        Partner::create($data);
        $this->showCreate = false;
        $this->reset('logoUpload');
    }

    public function edit(int $id): void
    {
        $this->editingId = $id;
        $row = Partner::findOrFail($id);
        $this->form = ['name' => $row->name, 'type' => $row->type, 'website' => $row->website, 'logo' => $row->logo];
        $this->reset('logoUpload');
        $this->showEdit = true;
    }

    public function update(): void
    {
        $data = $this->validate([
            'form.name' => 'required|string|max:255',
            'form.type' => 'required|in:ngo,company,gov,edu,other',
            'form.website' => 'nullable|string|max:255',
            'logoUpload' => 'nullable|image|max:2048',
        ])['form'];
        $partner = Partner::find($this->editingId);
        if ($partner && $this->logoUpload) {
            $newPath = $this->logoUpload->store('partners', 'public');
            if ($partner->logo) {
                Storage::disk('public')->delete($partner->logo);
            }
            $data['logo'] = $newPath;
        }
        Partner::whereKey($this->editingId)->update($data);
        $this->showEdit = false;
        $this->reset('logoUpload');
    }

    public function confirmDelete(int $id): void
    {
        $this->editingId = $id;
        $this->showDelete = true;
    }

    public function destroy(): void
    {
        $partner = Partner::find($this->editingId);
        if ($partner) {
            if ($partner->logo) {
                Storage::disk('public')->delete($partner->logo);
            }
            $partner->delete();
        }
        $this->showDelete = false;
    }

    public function render()
    {
        return view('livewire.partners-manager', ['paginator' => $this->paginator()]);
    }
}
