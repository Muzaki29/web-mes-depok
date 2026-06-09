<form wire:submit.prevent="{{ $action }}" class="space-y-4">
    <div>
        <label class="text-sm font-medium text-gray-700">Nama Lengkap</label>
        <input wire:model="form.name" type="text" class="mt-1 w-full text-sm border border-gray-200 rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500" placeholder="Dr. Nama Lengkap, S.E., M.M." />
        @error('form.name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="text-sm font-medium text-gray-700">Jabatan</label>
            <input wire:model="form.position" type="text" class="mt-1 w-full text-sm border border-gray-200 rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500" placeholder="Ketua Umum" />
            @error('form.position') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="text-sm font-medium text-gray-700">Divisi/Bidang</label>
            <input wire:model="form.division" type="text" list="division-list" class="mt-1 w-full text-sm border border-gray-200 rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500" placeholder="Badan Pengurus Harian" />
            <datalist id="division-list">
                @foreach($divisions as $d)
                    <option value="{{ $d }}">
                @endforeach
            </datalist>
            @error('form.division') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
        </div>
    </div>

    <div class="grid grid-cols-3 gap-4">
        <div>
            <label class="text-sm font-medium text-gray-700">Urutan</label>
            <input wire:model="form.sort_order" type="number" min="0" class="mt-1 w-full text-sm border border-gray-200 rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500" />
            @error('form.sort_order') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="text-sm font-medium text-gray-700">Periode</label>
            <input wire:model="form.period" type="text" class="mt-1 w-full text-sm border border-gray-200 rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500" placeholder="2026-2029" />
            @error('form.period') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="text-sm font-medium text-gray-700">Status</label>
            <select wire:model="form.status" class="mt-1 w-full text-sm border border-gray-200 rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500">
                <option value="active">Aktif</option>
                <option value="inactive">Nonaktif</option>
            </select>
            @error('form.status') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
        </div>
    </div>

    <div>
        <label class="text-sm font-medium text-gray-700">Foto Profil</label>
        <input wire:model="photo" type="file" accept="image/jpeg,image/png,image/webp" class="mt-1 w-full text-sm text-gray-600 file:mr-3 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100" />
        <p class="mt-1 text-xs text-gray-500">Opsional. JPG, PNG, atau WebP. Maks 2MB.</p>
        @error('photo') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
    </div>

    <div class="flex items-center justify-end gap-3 pt-2">
        <button type="button" wire:click="$set('{{ $action === 'store' ? 'showCreate' : 'showEdit' }}', false)" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">Batal</button>
        <button type="submit" class="px-4 py-2 text-sm font-semibold text-white bg-emerald-600 rounded-lg hover:bg-emerald-700 transition-colors">
            {{ $action === 'store' ? 'Simpan' : 'Perbarui' }}
        </button>
    </div>
</form>
