<div>
    <x-slot:hero>
        <div class="relative bg-emerald-900 text-white py-24 px-4 sm:px-6 lg:px-8 overflow-hidden">
            <div class="absolute inset-0">
                <img src="https://images.unsplash.com/photo-1544531586-fde5298cdd40?q=80&w=2070&auto=format&fit=crop" alt="Events Background" class="w-full h-full object-cover opacity-30">
                <div class="absolute inset-0 bg-linear-to-t from-emerald-900 via-emerald-900/40"></div>
            </div>
            <div class="relative max-w-7xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Event Ekonomi & Keuangan Syariah</h1>
                <p class="text-xl text-emerald-100 mb-10 max-w-2xl mx-auto">Cari event MES terdekat sesuai minat anda</p>
                
                <div class="bg-white/10 backdrop-blur-md p-4 rounded-xl border border-white/20 max-w-4xl mx-auto">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="md:col-span-2">
                            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari nama acara..." class="w-full px-4 py-3 rounded-lg bg-white/90 text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        </div>
                        <div>
                            <select wire:model.live="category" class="w-full px-4 py-3 rounded-lg bg-white/90 text-gray-900 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                                <option value="Semua">Semua Kategori</option>
                                <option value="Workshop">Workshop</option>
                                <option value="Seminar">Seminar</option>
                                <option value="Conference">Konferensi</option>
                                <option value="Training">Pelatihan</option>
                            </select>
                        </div>
                        <div>
                            <button type="button" x-data @click="document.getElementById('upcoming')?.scrollIntoView({ behavior: 'smooth' })" class="w-full px-4 py-3 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white font-semibold transition">
                                Cari Event
                            </button>
                        </div>
                    </div>
                    <div class="mt-4 flex flex-wrap gap-4 justify-center text-sm">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <span class="text-emerald-100">Dari:</span>
                            <input type="date" wire:model.live="date_start" class="px-2 py-1 rounded bg-white/20 border-white/30 text-white focus:outline-none focus:ring-1 focus:ring-emerald-500">
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <span class="text-emerald-100">Sampai:</span>
                            <input type="date" wire:model.live="date_end" class="px-2 py-1 rounded bg-white/20 border-white/30 text-white focus:outline-none focus:ring-1 focus:ring-emerald-500">
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </x-slot:hero>

    {{-- Sub Navbar Anchor --}}
    <div class="sticky top-0 z-10 bg-white border-b shadow-sm hidden md:block">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex justify-center space-x-8 py-4 text-sm font-medium text-gray-600">
                <a href="#upcoming" class="hover:text-emerald-600 transition">Event Mendatang</a>
                <a href="#categories" class="hover:text-emerald-600 transition">Jenis Kegiatan</a>
                <a href="#stats" class="hover:text-emerald-600 transition">Capaian</a>
                <a href="#gallery" class="hover:text-emerald-600 transition">Galeri</a>
                <a href="#partners" class="hover:text-emerald-600 transition">Mitra Kerja</a>
                <a href="#past" class="hover:text-emerald-600 transition">Event Kemarin</a>
            </nav>
        </div>
    </div>

    {{-- Upcoming Events --}}
    <section id="upcoming" class="py-16">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 uppercase tracking-wide">Event Mendatang</h2>
            <p class="mt-2 text-gray-600">Jelajahi dan temukan event yang anda ingin ikuti</p>
            <div class="w-20 h-1 bg-emerald-500 mx-auto mt-4 rounded-full"></div>
        </div>

        @if($upcomingEvents->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($upcomingEvents as $event)
                <div class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 hover:-translate-y-1">
                    <div class="relative h-48 overflow-hidden">
                        @if($event->thumbnail)
                            <img src="{{ Storage::url($event->thumbnail) }}" alt="{{ $event->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        @else
                            <div class="w-full h-full bg-linear-to-br from-emerald-100 to-emerald-50 flex items-center justify-center">
                                <svg class="w-12 h-12 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-semibold text-emerald-700 shadow-sm">
                            {{ $event->category ?? 'General' }}
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center text-xs text-gray-500 mb-3 gap-2">
                            <span class="flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> {{ $event->start_at->format('d M Y') }}</span>
                            <span class="flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg> {{ Str::limit($event->location, 15) }}</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-emerald-600 transition">{{ $event->title }}</h3>
                        <p class="text-gray-600 text-sm line-clamp-2 mb-4">{{ $event->description }}</p>
                        <a href="{{ route('events.show', $event->slug) }}" class="inline-flex items-center text-emerald-600 font-semibold text-sm hover:underline">
                            Lihat Detail <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12 bg-white rounded-xl border border-dashed border-gray-300">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada event mendatang</h3>
                <p class="mt-1 text-sm text-gray-500">Silakan cek kembali nanti atau lihat event yang sudah berlalu.</p>
            </div>
        @endif
    </section>

    {{-- Categories --}}
    <section id="categories" class="py-16 border-t border-gray-100">
        <div class="text-center mb-12">
            <h2 class="text-2xl font-bold text-gray-900 uppercase tracking-wide">Jenis Kegiatan</h2>
            <div class="w-16 h-1 bg-emerald-500 mx-auto mt-4 rounded-full"></div>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach(['Asuransi Syariah', 'Pasar Modal Syariah', 'Multifinance Syariah', 'Gadaian Emas', 'Perencanaan Keuangan', 'Investasi UMKM', 'Waqf Goes to Campus', 'Lainnya'] as $cat)
            <div class="group bg-white p-6 rounded-xl shadow-sm hover:shadow-md border border-gray-100 text-center transition cursor-pointer hover:border-emerald-200">
                <div class="w-12 h-12 mx-auto bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center mb-4 group-hover:bg-emerald-600 group-hover:text-white transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <h3 class="font-medium text-gray-900 group-hover:text-emerald-700 transition">{{ $cat }}</h3>
            </div>
            @endforeach
        </div>
    </section>

    {{-- Stats (Capaian) --}}
    <section id="stats" class="py-20 -mx-4 sm:-mx-6 lg:-mx-8 bg-emerald-900 text-white relative overflow-hidden">
        <div class="absolute inset-0">
             <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?q=80&w=2032&auto=format&fit=crop" class="w-full h-full object-cover opacity-10 mix-blend-overlay">
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-2 uppercase tracking-wide">Capaian Kegiatan</h2>
            <p class="text-emerald-200 mb-12">Data dalam kurun waktu 4 tahun terakhir (2021 - 2024)</p>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="p-6 bg-white/5 backdrop-blur rounded-xl border border-white/10 hover:bg-white/10 transition">
                    <div class="text-4xl font-bold text-emerald-400 mb-2">{{ $stats['network'] }}</div>
                    <div class="text-sm uppercase tracking-wider text-emerald-200">Jaringan Organisasi</div>
                </div>
                <div class="p-6 bg-white/5 backdrop-blur rounded-xl border border-white/10 hover:bg-white/10 transition">
                    <div class="text-4xl font-bold text-emerald-400 mb-2">{{ $stats['activities'] }}</div>
                    <div class="text-sm uppercase tracking-wider text-emerald-200">Kegiatan Literasi</div>
                </div>
                <div class="p-6 bg-white/5 backdrop-blur rounded-xl border border-white/10 hover:bg-white/10 transition">
                    <div class="text-4xl font-bold text-emerald-400 mb-2">{{ number_format($stats['beneficiaries']) }}</div>
                    <div class="text-sm uppercase tracking-wider text-emerald-200">Penerima Manfaat</div>
                </div>
                <div class="p-6 bg-white/5 backdrop-blur rounded-xl border border-white/10 hover:bg-white/10 transition">
                    <div class="text-4xl font-bold text-emerald-400 mb-2">{{ $stats['partners'] }}+</div>
                    <div class="text-sm uppercase tracking-wider text-emerald-200">Mitra</div>
                </div>
            </div>
        </div>
    </section>

    {{-- Gallery Slider --}}
    <section id="gallery" class="py-16 bg-gray-50 -mx-4 sm:-mx-6 lg:-mx-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-2xl font-bold text-gray-900 uppercase tracking-wide">Galeri Dokumentasi</h2>
                <p class="mt-2 text-gray-600">Kami telah menyelenggarakan kegiatan untuk skala nasional, regional, dan daerah.</p>
                <div class="w-16 h-1 bg-emerald-500 mx-auto mt-4 rounded-full"></div>
            </div>

            <div x-data="{
                activeSlide: 0,
                slides: [
                    'https://images.unsplash.com/photo-1544531586-fde5298cdd40?q=80&w=2070',
                    'https://images.unsplash.com/photo-1561489413-985b06da5bee?q=80&w=2070',
                    'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?q=80&w=2032',
                    'https://images.unsplash.com/photo-1551818255-e6e10975bc17?q=80&w=1973'
                ],
                next() { this.activeSlide = (this.activeSlide + 1) % this.slides.length },
                prev() { this.activeSlide = (this.activeSlide - 1 + this.slides.length) % this.slides.length }
            }" class="relative w-full max-w-5xl mx-auto rounded-2xl overflow-hidden shadow-2xl group">
                
                <div class="relative h-100 md:h-125">
                    <template x-for="(slide, index) in slides" :key="index">
                        <div x-show="activeSlide === index"
                             x-transition:enter="transition transform duration-500 ease-out"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition transform duration-300 ease-in"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute inset-0 w-full h-full">
                            <img :src="slide" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-linear-to-t from-black/60 to-transparent"></div>
                            <div class="absolute bottom-8 left-8 text-white">
                                <h3 class="text-2xl font-bold" x-text="'Dokumentasi Kegiatan ' + (index + 1)"></h3>
                                <p class="text-gray-200">Deskripsi singkat kegiatan yang telah dilaksanakan.</p>
                            </div>
                        </div>
                    </template>
                </div>

                <button @click="prev()" class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white/40 backdrop-blur p-2 rounded-full text-white transition opacity-0 group-hover:opacity-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </button>
                <button @click="next()" class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white/40 backdrop-blur p-2 rounded-full text-white transition opacity-0 group-hover:opacity-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </button>

                <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2">
                    <template x-for="(slide, index) in slides" :key="index">
                        <button @click="activeSlide = index" :class="activeSlide === index ? 'bg-emerald-500 w-6' : 'bg-white/50 w-2'" class="h-2 rounded-full transition-all duration-300"></button>
                    </template>
                </div>
            </div>
        </div>
    </section>

    {{-- Partners --}}
    <section id="partners" class="py-16">
        <div class="text-center mb-12">
            <h2 class="text-2xl font-bold text-gray-900 uppercase tracking-wide">Mitra Kerja</h2>
            <div class="w-16 h-1 bg-emerald-500 mx-auto mt-4 rounded-full"></div>
        </div>
        <div class="flex flex-wrap justify-center gap-8 md:gap-12 grayscale opacity-70 hover:grayscale-0 hover:opacity-100 transition duration-500">
            @forelse($partners as $partner)
                <img src="{{ $partner->logo ? Storage::url($partner->logo) : 'https://placehold.co/150x60?text='.urlencode($partner->name) }}" alt="{{ $partner->name }}" class="h-12 object-contain">
            @empty
                <!-- Fallback Partners -->
                <img src="https://placehold.co/150x60?text=Bank+Syariah" class="h-12 object-contain">
                <img src="https://placehold.co/150x60?text=OJK" class="h-12 object-contain">
                <img src="https://placehold.co/150x60?text=Baznas" class="h-12 object-contain">
                <img src="https://placehold.co/150x60?text=Kemenag" class="h-12 object-contain">
            @endforelse
        </div>
    </section>

    {{-- Past Events --}}
    <section id="past" class="py-16 border-t border-gray-100">
        <div class="text-center mb-12">
            <h2 class="text-2xl font-bold text-gray-900 uppercase tracking-wide">Event Kemarin</h2>
            <p class="mt-2 text-gray-600">Temukan dan saksikan ulang event MES yang sebelumnya anda lewatkan.</p>
            <div class="w-16 h-1 bg-emerald-500 mx-auto mt-4 rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($pastEvents as $event)
            <div class="flex bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100 hover:shadow-md transition">
                <div class="w-1/3 bg-gray-200 relative">
                    @if($event->thumbnail)
                        <img src="{{ Storage::url($event->thumbnail) }}" class="absolute inset-0 w-full h-full object-cover">
                    @else
                         <div class="absolute inset-0 flex items-center justify-center bg-gray-100 text-gray-400">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                         </div>
                    @endif
                </div>
                <div class="w-2/3 p-4 flex flex-col justify-between">
                    <div>
                        <div class="text-xs text-gray-500 mb-1">{{ $event->start_at->format('d M Y') }}</div>
                        <h3 class="font-bold text-gray-900 line-clamp-2 text-sm">{{ $event->title }}</h3>
                    </div>
                    <a href="{{ route('events.show', $event->slug) }}" class="text-xs font-semibold text-emerald-600 mt-2 hover:underline">Lihat Dokumentasi</a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-8 flex justify-center">
            {{ $pastEvents->links() }}
        </div>
    </section>
</div>
