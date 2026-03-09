@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold">Documents</h1>
    <x-button>Upload File</x-button>
</div>
<livewire:documents-manager />
@endsection

