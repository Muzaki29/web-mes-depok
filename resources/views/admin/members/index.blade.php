@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold">Members</h1>
    <div class="flex items-center gap-2">
        <x-button>Invite Member</x-button>
        <x-button variant="secondary">Export CSV</x-button>
    </div>
 </div>
 <livewire:members-table />
@endsection

