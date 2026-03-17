<?php

namespace App\Livewire;

use App\Models\Partner;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class PartnersManager extends Component
{
    use WithFileUploads, WithPagination;

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

    public function updatedPerPage(): void
    {
        $this->resetPage();
    }

    #[On('openCreatePartner')]
    public function openCreatePartner(): void
    {
        $this->create();
    }

    public function getQuery()
    {
        return Partner::query()
            ->when($this->search !== '', function ($q) {
                $s = '%'.$this->search.'%';
                $q->where(function ($sub) use ($s) {
                    $sub->where('name', 'like', $s)
                        ->orWhere('type', 'like', $s)
                        ->orWhere('website', 'like', $s);
                });
            })
            ->orderBy('name');
    }

    public function create(): void
    {
        $this->closeModals();
        $this->editingId = null;
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
        $this->closeModals();
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
        $this->closeModals();
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
        return view('livewire.partners-manager', [
            'paginator' => $this->getQuery()->paginate($this->perPage),
        ]);
    }
}
