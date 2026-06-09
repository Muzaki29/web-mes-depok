<?php

namespace App\Livewire;

use App\Models\OrganizationMember;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class OrganizationManager extends Component
{
    use WithFileUploads, WithPagination;

    public string $search = '';
    public string $filterDivision = 'all';
    public int $perPage = 20;

    public bool $showCreate = false;
    public bool $showEdit = false;
    public bool $showDelete = false;
    public ?int $editingId = null;

    public array $form = [
        'name' => '',
        'position' => '',
        'division' => '',
        'sort_order' => 0,
        'period' => '2026-2029',
        'status' => 'active',
    ];

    public $photo = null;

    protected function rules(): array
    {
        return [
            'form.name' => 'required|string|max:255',
            'form.position' => 'required|string|max:255',
            'form.division' => 'required|string|max:255',
            'form.sort_order' => 'required|integer|min:0',
            'form.period' => 'required|string|max:20',
            'form.status' => 'required|in:active,inactive',
            'photo' => 'nullable|image|mimes:jpeg,png,webp|max:2048',
        ];
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedFilterDivision(): void
    {
        $this->resetPage();
    }

    public function getDivisionsProperty(): array
    {
        return OrganizationMember::query()
            ->select('division')
            ->distinct()
            ->orderBy('division')
            ->pluck('division')
            ->toArray();
    }

    public function create(): void
    {
        $this->closeModals();
        $this->form = [
            'name' => '',
            'position' => '',
            'division' => '',
            'sort_order' => OrganizationMember::max('sort_order') + 1,
            'period' => '2026-2029',
            'status' => 'active',
        ];
        $this->photo = null;
        $this->showCreate = true;
    }

    public function store(): void
    {
        $this->validate();

        $data = $this->form;

        if ($this->photo) {
            $data['photo'] = $this->photo->store('organization', 'public');
        }

        OrganizationMember::create($data);
        Cache::forget('org_structure');
        $this->closeModals();
    }

    public function edit(int $id): void
    {
        $this->closeModals();
        $member = OrganizationMember::findOrFail($id);
        $this->editingId = $id;
        $this->form = [
            'name' => $member->name,
            'position' => $member->position,
            'division' => $member->division,
            'sort_order' => $member->sort_order,
            'period' => $member->period,
            'status' => $member->status,
        ];
        $this->photo = null;
        $this->showEdit = true;
    }

    public function update(): void
    {
        $this->validate();

        $member = OrganizationMember::findOrFail($this->editingId);
        $data = $this->form;

        if ($this->photo) {
            if ($member->photo && Storage::disk('public')->exists($member->photo)) {
                Storage::disk('public')->delete($member->photo);
            }
            $data['photo'] = $this->photo->store('organization', 'public');
        }

        $member->update($data);
        Cache::forget('org_structure');
        $this->closeModals();
    }

    public function confirmDelete(int $id): void
    {
        $this->closeModals();
        $this->editingId = $id;
        $this->showDelete = true;
    }

    public function destroy(): void
    {
        $member = OrganizationMember::find($this->editingId);
        if ($member) {
            if ($member->photo && Storage::disk('public')->exists($member->photo)) {
                Storage::disk('public')->delete($member->photo);
            }
            $member->delete();
            Cache::forget('org_structure');
        }
        $this->closeModals();
    }

    private function closeModals(): void
    {
        $this->showCreate = false;
        $this->showEdit = false;
        $this->showDelete = false;
        $this->editingId = null;
        $this->photo = null;
    }

    public function render()
    {
        $query = OrganizationMember::query()
            ->when($this->filterDivision !== 'all', fn ($q) => $q->where('division', $this->filterDivision))
            ->when(trim($this->search) !== '', function ($q) {
                $s = '%' . trim($this->search) . '%';
                $q->where(function ($sub) use ($s) {
                    $sub->where('name', 'like', $s)
                        ->orWhere('position', 'like', $s)
                        ->orWhere('division', 'like', $s);
                });
            })
            ->orderBy('sort_order');

        return view('livewire.organization-manager', [
            'paginator' => $query->paginate($this->perPage),
            'divisions' => $this->divisions,
        ]);
    }
}
