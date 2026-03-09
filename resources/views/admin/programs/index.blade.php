@extends('layouts.app')

@section('content')
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Kelola Program</h1>
        <p class="text-sm text-gray-500 mt-1">Daftar program kerja dan kegiatan organisasi.</p>
    </div>
    <a href="{{ route('admin.programs.create') }}" class="inline-flex items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-700 focus:bg-emerald-700 active:bg-emerald-900 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Program
    </a>
</div>

@if(session('success'))
<div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl relative" role="alert">
    <strong class="font-bold">Berhasil!</strong>
    <span class="block sm:inline">{{ session('success') }}</span>
</div>
@endif

<div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b border-gray-100">
                <tr>
                    <th scope="col" class="px-6 py-4">Thumbnail</th>
                    <th scope="col" class="px-6 py-4">Judul Program</th>
                    <th scope="col" class="px-6 py-4">Kategori</th>
                    <th scope="col" class="px-6 py-4">Status</th>
                    <th scope="col" class="px-6 py-4">Dibuat</th>
                    <th scope="col" class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($programs as $program)
                <tr class="bg-white hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        @if($program->thumbnail)
                            <img src="{{ str_starts_with($program->thumbnail, 'http') ? $program->thumbnail : asset('storage/'.$program->thumbnail) }}" class="w-16 h-10 object-cover rounded-lg border border-gray-200" alt="">
                        @else
                            <div class="w-16 h-10 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-900">
                        {{ $program->title }}
                        <div class="text-xs text-gray-400 mt-0.5 font-normal">{{ Str::limit($program->description, 50) }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                            {{ $program->category ?? '-' }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $program->status === 'active' ? 'bg-emerald-100 text-emerald-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ ucfirst($program->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        {{ $program->created_at->format('d M Y') }}
                    </td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <a href="{{ route('admin.programs.edit', $program) }}" class="font-medium text-emerald-600 hover:underline">Edit</a>
                        <form action="{{ route('admin.programs.destroy', $program) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus program ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="font-medium text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                        Belum ada program yang dibuat.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 border-t border-gray-100">
        {{ $programs->links() }}
    </div>
</div>
@endsection
