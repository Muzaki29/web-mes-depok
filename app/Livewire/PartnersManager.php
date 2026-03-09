<?php

namespace App\Livewire;

use App\Models\Partner;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;

class PartnersManager extends Component
{
    public string $search = '';
    public int $perPage = 10;
    public $partners;
    public bool $showCreate = false;
    public bool $showEdit = false;
    public bool $showDelete = false;
    public ?int $editingId = null;
    public array $form = [
        'name' => '',
        'type' => 'company',
        'website' => '',
    ];

    public function mount(): void {}

    protected function filtered(): array
    {
        $query = Partner::query()
            ->when($this->search !== '', function ($q) {
                $s = '%'.$this->search.'%';
                $q->where(function ($sub) use ($s) {
                    $sub->where('name','like',$s)
                        ->orWhere('type','like',$s)
                        ->orWhere('website','like',$s);
                });
            })
            ->orderBy('name');
        return $query->get()->toArray();
    }

    public function paginator(): LengthAwarePaginator
    {
        $data = $this->filtered();
        $page = request()->input('page', 1);
        $items = array_slice($data, ($page-1)*$this->perPage, $this->perPage);
        return new LengthAwarePaginator($items, count($data), $this->perPage, $page, ['path'=>request()->url(),'query'=>request()->query()]);
    }

    public function create(): void
    {
        $this->form = ['name'=>'','type'=>'company','website'=>''];
        $this->showCreate = true;
    }

    public function store(): void
    {
        $data = $this->validate([
            'form.name' => 'required|string|max:255',
            'form.type' => 'required|in:ngo,company,gov,edu,other',
            'form.website' => 'nullable|string|max:255',
        ])['form'];
        Partner::create($data);
        $this->showCreate = false;
    }

    public function edit(int $id): void
    {
        $this->editingId = $id;
        $row = Partner::findOrFail($id);
        $this->form = ['name'=>$row->name,'type'=>$row->type,'website'=>$row->website];
        $this->showEdit = true;
    }

    public function update(): void
    {
        $data = $this->validate([
            'form.name' => 'required|string|max:255',
            'form.type' => 'required|in:ngo,company,gov,edu,other',
            'form.website' => 'nullable|string|max:255',
        ])['form'];
        Partner::whereKey($this->editingId)->update($data);
        $this->showEdit = false;
    }

    public function confirmDelete(int $id): void
    {
        $this->editingId = $id;
        $this->showDelete = true;
    }

    public function destroy(): void
    {
        Partner::whereKey($this->editingId)->delete();
        $this->showDelete = false;
    }

    public function render()
    {
        return view('livewire.partners-manager', ['paginator'=>$this->paginator()]);
    }
}
