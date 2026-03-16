<?php

namespace App\Livewire;

use App\Models\Member;
use App\Models\MemberCategory;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class MembersTable extends Component
{
    use WithPagination;

    public string $search = '';

    public int $perPage = 10;

    // Bulk Actions
    public array $selected = [];

    public bool $selectAll = false;

    public bool $showBulkDelete = false;

    public ?int $editingId = null;

    public bool $showCreate = false;

    public bool $showEdit = false;

    public bool $showDelete = false;

    public array $form = [
        'name' => '',
        'membership_no' => '',
        'category' => 'Standard',
        'status' => 'Active',
        'valid_until' => '',
    ];

    private function closeModals(): void
    {
        $this->showCreate = false;
        $this->showEdit = false;
        $this->showDelete = false;
        $this->showBulkDelete = false;
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selected = $this->getQuery()->pluck('id')->map(fn ($id) => (string) $id)->toArray();
        } else {
            $this->selected = [];
        }
    }

    public function updatedSelected()
    {
        $this->selectAll = false;
        if (count($this->selected) === 0) {
            $this->showBulkDelete = false;
        }
    }

    public function getQuery()
    {
        return Member::query()
            ->with('category')
            ->when($this->search !== '', function ($q) {
                $s = '%'.$this->search.'%';
                $q->where(function ($sub) use ($s) {
                    $sub->where('name', 'like', $s)
                        ->orWhere('membership_no', 'like', $s)
                        ->orWhere('status', 'like', $s);
                });
            })
            ->orderBy('name');
    }

    public function render()
    {
        return view('livewire.members-table', [
            'paginator' => $this->getQuery()->paginate($this->perPage),
        ]);
    }

    public function create(): void
    {
        $this->closeModals();
        $this->form = [
            'name' => '',
            'membership_no' => 'EC-'.date('Y').'-'.rand(1000, 9999),
            'category' => 'Standard',
            'status' => 'Active',
            'valid_until' => date('Y-m-d', strtotime('+1 year')),
        ];
        $this->showCreate = true;
    }

    public function store(): void
    {
        if (($this->form['valid_until'] ?? null) === '') {
            $this->form['valid_until'] = null;
        }
        $data = $this->validate([
            'form.name' => 'required|string|max:255',
            'form.membership_no' => 'required|string|max:255|unique:members,membership_no',
            'form.category' => 'nullable|string|max:255',
            'form.status' => 'required|string',
            'form.valid_until' => 'nullable|date',
        ])['form'];
        $category = MemberCategory::firstOrCreate(['name' => $data['category'] ?? 'Standard']);
        Member::create([
            'name' => $data['name'],
            'membership_no' => $data['membership_no'],
            'category_id' => $category->id,
            'status' => strtolower($data['status']),
            'valid_until' => $data['valid_until'] ?? null,
        ]);
        $this->showCreate = false;
        $this->dispatch('toast', message: 'Anggota berhasil dibuat');
    }

    public function edit(int $id): void
    {
        $this->closeModals();
        $this->editingId = $id;
        $member = Member::find($id);
        if ($member) {
            $this->form = [
                'name' => $member->name,
                'membership_no' => $member->membership_no,
                'category' => optional($member->category)->name ?? 'Standard',
                'status' => ucfirst($member->status),
                'valid_until' => optional($member->valid_until)->format('Y-m-d'),
            ];
            $this->showEdit = true;
        }
    }

    public function update(): void
    {
        if (($this->form['valid_until'] ?? null) === '') {
            $this->form['valid_until'] = null;
        }
        $data = $this->validate([
            'form.name' => 'required|string|max:255',
            'form.membership_no' => 'required|string|max:255|unique:members,membership_no,'.$this->editingId,
            'form.category' => 'nullable|string|max:255',
            'form.status' => 'required|string',
            'form.valid_until' => 'nullable|date',
        ])['form'];
        $category = MemberCategory::firstOrCreate(['name' => $data['category'] ?? 'Standard']);
        Member::whereKey($this->editingId)->update([
            'name' => $data['name'],
            'membership_no' => $data['membership_no'],
            'category_id' => $category->id,
            'status' => strtolower($data['status']),
            'valid_until' => $data['valid_until'] ?? null,
        ]);
        $this->showEdit = false;
        $this->dispatch('toast', message: 'Anggota berhasil diperbarui');
    }

    public function confirmDelete(int $id): void
    {
        $this->closeModals();
        $this->editingId = $id;
        $this->showDelete = true;
    }

    public function destroy(): void
    {
        Member::whereKey($this->editingId)->delete();
        $this->showDelete = false;
        $this->dispatch('toast', message: 'Anggota berhasil dihapus');
    }

    public function confirmBulkDelete(): void
    {
        $this->closeModals();
        $this->showBulkDelete = count($this->selected) > 0;
    }

    public function destroySelected(): void
    {
        Member::whereIn('id', $this->selected)->delete();
        $this->selected = [];
        $this->selectAll = false;
        $this->showBulkDelete = false;
        $this->dispatch('toast', message: 'Anggota terpilih berhasil dihapus');
    }

    #[On('refreshMembers')]
    public function refreshMembers(): void {}

    #[On('openCreateMember')]
    public function openCreateMember(): void
    {
        $this->create();
    }
}
