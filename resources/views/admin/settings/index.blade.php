@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold mb-6">Settings</h1>
<x-card>
    <x-slot:title>General Settings</x-slot:title>
    <form class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <label class="text-sm text-gray-600">Organization Name</label>
            <input class="mt-1 w-full rounded-md border-gray-300" value="EconoComm" />
        </div>
        <div>
            <label class="text-sm text-gray-600">Primary Color</label>
            <input type="color" class="mt-1 w-full rounded-md border-gray-300" value="#16a34a" />
        </div>
        <div class="sm:col-span-2">
            <x-button>Save</x-button>
        </div>
    </form>
 </x-card>
@endsection

