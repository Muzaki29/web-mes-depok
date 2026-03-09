@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold">Consultations</h1>
    <x-button>New Consultation</x-button>
</div>
<x-table>
    <x-slot:head>
        <tr>
            <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Requester</th>
            <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Topic</th>
            <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Status</th>
            <th class="px-4 py-3"></th>
        </tr>
    </x-slot:head>
    @foreach([['Ahmad Rahman','Ethical Finance','Scheduled'],['Fatima Khan','SME Support','Submitted']] as $c)
    <tr>
        <td class="px-4 py-3">{{ $c[0] }}</td>
        <td class="px-4 py-3">{{ $c[1] }}</td>
        <td class="px-4 py-3">{{ $c[2] }}</td>
        <td class="px-4 py-3 text-right"><x-button size="sm" variant="secondary">View</x-button></td>
    </tr>
    @endforeach
</x-table>
@endsection

