<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicSite\ArticleController as PublicArticleController;
use App\Http\Controllers\PublicSite\ContactController as PublicContactController;
use App\Http\Controllers\PublicSite\DocumentController as PublicDocumentController;
use App\Http\Controllers\PublicSite\EventController as PublicEventController;
use App\Http\Controllers\PublicSite\MembershipController as PublicMembershipController;
use App\Http\Controllers\PublicSite\ProgramController as PublicProgramController;
use App\Models\Article;
use App\Models\Consultation;
use App\Models\Document;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\Member;
use App\Models\Partner as PartnerModel;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

Route::get('/', function () {
    $homeSettings = [];
    if (Schema::hasTable('site_settings')) {
        $homeSettings = Cache::remember('home_site_settings', 600, fn () => SiteSetting::query()
            ->where('key', 'like', 'home.%')
            ->pluck('value', 'key')
            ->toArray()
        );
    }
    $metrics = Cache::remember('home_metrics', 600, function () {
        return [
            'members' => Member::count(),
            'partners' => PartnerModel::count(),
            'events_this_year' => Event::whereYear('start_at', now()->year)->count(),
        ];
    });
    $upcomingEvents = Cache::remember('home_upcoming_events', 600, fn () => Event::where('start_at', '>=', now())->orderBy('start_at')->limit(5)->get());
    $latestArticles = Cache::remember('home_latest_articles', 600, fn () => Article::where('status', 'published')->orderByDesc('published_at')->limit(5)->get());
    $partners = Cache::remember('home_partners', 600, fn () => PartnerModel::orderBy('name')->limit(8)->get());

    return view('public.home', compact('homeSettings', 'metrics', 'upcomingEvents', 'latestArticles', 'partners'));
})->name('home');
Route::get('/news', function (\Illuminate\Http\Request $request) {
    $query = Article::where('status', 'published');

    if ($request->has('q')) {
        $search = $request->q;
        $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
                ->orWhere('excerpt', 'like', "%{$search}%")
                ->orWhere('body', 'like', "%{$search}%");
        });
    }

    $articles = $query->orderByDesc('published_at')->paginate(9);

    return view('public.news', compact('articles'));
})->name('news');
Route::get('/news/{slug}', [PublicArticleController::class, 'show'])->name('news.show');
Route::get('/documents/{slug}/download', [PublicDocumentController::class, 'download'])->name('documents.download');
Route::get('/events', \App\Livewire\PublicEvents::class)->name('events');
Route::get('/events/{slug}', [PublicEventController::class, 'show'])->name('events.show');
Route::post('/events/{slug}/register', [PublicEventController::class, 'register'])->name('events.register');
Route::get('/contact', [PublicContactController::class, 'create'])->name('contact');
Route::post('/contact', [PublicContactController::class, 'store'])->name('contact.submit');
Route::get('/programs', [PublicProgramController::class, 'index'])->name('programs');
Route::get('/programs/{slug}', [PublicProgramController::class, 'show'])->name('programs.show');
Route::get('/membership', [PublicMembershipController::class, 'create'])->name('membership');
Route::post('/membership', [PublicMembershipController::class, 'store'])->name('membership.submit');

Route::view('/about', 'public.about.profile')->name('about');
Route::view('/about/anggaran-dasar', 'public.about.statute')->name('about.statute');
Route::view('/about/visi-misi', 'public.about.vision')->name('about.vision');
Route::view('/about/roadmap', 'public.about.roadmap')->name('about.roadmap');
Route::view('/about/sebaran-jaringan', 'public.about.network')->name('about.network');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:10,1');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
    Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');
});
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::prefix('admin')->middleware(['auth', 'role:super_admin,org_admin'])->group(function () {
    Route::get('/dashboard', function () {
        $totalMembers = Cache::remember('dash_total_members', 60, fn () => Member::count());
        $upcomingEvents = Cache::remember('dash_upcoming_events', 60, fn () => Event::where('start_at', '>=', now())->count());
        $activeConsultations = Cache::remember('dash_active_consultations', 60, fn () => \App\Models\Consultation::whereIn('status', ['assigned', 'scheduled'])->count());
        $documentsCount = Cache::remember('dash_documents_count', 60, fn () => Document::count());
        $recentMembers = Member::with('category')->latest()->limit(5)->get();
        $recentDocuments = Document::latest()->limit(5)->get();
        $latestRegistrations = EventRegistration::with('event')->latest()->limit(5)->get();
        $recentAnnouncements = collect([(object) ['title' => 'Policy Update'], (object) ['title' => 'Maintenance Window']]);
        $activities = collect([
            'Anggota baru terdaftar',
            'Dokumen diunggah',
            'Agenda dibuat',
            'Konsultasi dijadwalkan',
        ]);

        return view('admin.dashboard', compact(
            'totalMembers', 'upcomingEvents', 'activeConsultations', 'documentsCount',
            'recentMembers', 'recentDocuments', 'latestRegistrations', 'recentAnnouncements', 'activities'
        ));
    })->name('admin.dashboard');
    Route::get('/dashboard/summary', function () {
        return response()->json([
            'totalMembers' => Member::count(),
            'upcomingEvents' => Event::where('start_at', '>=', now())->count(),
            'activeConsultations' => \App\Models\Consultation::whereIn('status', ['assigned', 'scheduled'])->count(),
            'documentsCount' => Document::count(),
            'serverTime' => now()->toIso8601String(),
        ]);
    })->name('admin.dashboard.summary');
    Route::view('/members', 'admin.members.index')->name('admin.members');
    Route::get('/members/export-csv', function () {
        $fileName = 'anggota-'.now()->format('Y-m-d').'.csv';

        return response()->streamDownload(function () {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['ID', 'Nama', 'No Anggota', 'Kategori', 'Status', 'Berlaku Sampai']);

            Member::query()
                ->with('category')
                ->orderBy('name')
                ->chunk(500, function ($members) use ($out) {
                    foreach ($members as $m) {
                        fputcsv($out, [
                            $m->id,
                            $m->name,
                            $m->membership_no,
                            optional($m->category)->name,
                            $m->status,
                            optional($m->valid_until)->format('Y-m-d'),
                        ]);
                    }
                });

            fclose($out);
        }, $fileName, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    })->name('admin.members.export_csv');
    Route::get('/consultations/export-csv', function () {
        $fileName = 'konsultasi-'.now()->format('Y-m-d').'.csv';

        return response()->streamDownload(function () {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['ID', 'Pemohon', 'Topik', 'Status', 'Jadwal', 'Dibuat']);

            Consultation::query()
                ->orderByDesc('id')
                ->chunk(500, function ($rows) use ($out) {
                    foreach ($rows as $c) {
                        fputcsv($out, [
                            $c->id,
                            $c->requester_name,
                            $c->topic,
                            $c->status,
                            optional($c->scheduled_at)->format('Y-m-d H:i'),
                            optional($c->created_at)->format('Y-m-d H:i'),
                        ]);
                    }
                });

            fclose($out);
        }, $fileName, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    })->name('admin.consultations.export_csv');
    Route::get('/events/export-csv', function () {
        $fileName = 'agenda-'.now()->format('Y-m-d').'.csv';

        return response()->streamDownload(function () {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['ID', 'Judul', 'Kategori', 'Mulai', 'Selesai', 'Lokasi', 'Kuota', 'Publik', 'Dibuat']);

            Event::query()
                ->orderByDesc('start_at')
                ->chunk(500, function ($rows) use ($out) {
                    foreach ($rows as $e) {
                        fputcsv($out, [
                            $e->id,
                            $e->title,
                            $e->category,
                            optional($e->start_at)->format('Y-m-d H:i'),
                            optional($e->end_at)->format('Y-m-d H:i'),
                            $e->location,
                            $e->capacity,
                            $e->is_public ? 'Ya' : 'Tidak',
                            optional($e->created_at)->format('Y-m-d H:i'),
                        ]);
                    }
                });

            fclose($out);
        }, $fileName, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    })->name('admin.events.export_csv');
    Route::get('/documents/export-csv', function () {
        $fileName = 'dokumen-'.now()->format('Y-m-d').'.csv';

        return response()->streamDownload(function () {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['ID', 'Judul', 'Kategori', 'Visibilitas', 'Role', 'Path', 'Mime', 'Ukuran (bytes)', 'Dibuat']);

            Document::query()
                ->with('category')
                ->orderByDesc('id')
                ->chunk(500, function ($rows) use ($out) {
                    foreach ($rows as $d) {
                        fputcsv($out, [
                            $d->id,
                            $d->title,
                            optional($d->category)->name,
                            $d->visibility,
                            $d->role,
                            $d->path,
                            $d->mime,
                            $d->size,
                            optional($d->created_at)->format('Y-m-d H:i'),
                        ]);
                    }
                });

            fclose($out);
        }, $fileName, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    })->name('admin.documents.export_csv');
    Route::view('/events', 'admin.events.index')->name('admin.events');
    Route::view('/letters', 'admin.letters.index')->name('admin.letters');
    Route::view('/announcements', 'admin.announcements.index')->name('admin.announcements');
    Route::view('/articles', 'admin.articles.index')->name('admin.articles.index');
    Route::view('/applications', 'admin.applications.index')->name('admin.applications');
    Route::view('/broadcast', 'admin.broadcast.index')->name('admin.broadcast');
    Route::view('/consultations', 'admin.consultations.index')->name('admin.consultations');
    Route::view('/partners', 'admin.partners.index')->name('admin.partners');
    Route::view('/documents', 'admin.documents.index')->name('admin.documents');
    Route::view('/reports', 'admin.reports.index')->name('admin.reports');
    Route::view('/notifications', 'admin.notifications.index')->name('admin.notifications');
    Route::view('/settings', 'admin.settings.index')->name('admin.settings');
    Route::post('/settings', function (Request $request) {
        $validated = $request->validate([
            'org_name' => ['required', 'string', 'max:80'],
            'primary_color' => ['required', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
        ]);

        if (Schema::hasTable('site_settings')) {
            SiteSetting::setValue('org.name', $validated['org_name']);
            SiteSetting::setValue('theme.primary_color', $validated['primary_color']);
            Cache::forget('org_name');
            Cache::forget('theme_primary_color');
        }

        return redirect()->route('admin.settings')->with('status', 'Pengaturan berhasil disimpan.');
    })->name('admin.settings.save');
    Route::get('/appearance/home', function () {
        $settings = [];
        if (Schema::hasTable('site_settings')) {
            $settings = SiteSetting::query()
                ->where('key', 'like', 'home.%')
                ->pluck('value', 'key')
                ->toArray();
        }

        return view('admin.appearance.home', compact('settings'));
    })->name('admin.appearance.home');
    Route::post('/appearance/home', function (Request $request) {
        if (! Schema::hasTable('site_settings')) {
            return redirect()->route('admin.appearance.home')->with('status', 'Perubahan landing page berhasil disimpan.');
        }

        $validUrl = function (?string $value): bool {
            if ($value === null || trim($value) === '') {
                return true;
            }

            $value = trim($value);
            if (str_starts_with($value, '/')) {
                return true;
            }

            return filter_var($value, FILTER_VALIDATE_URL) !== false;
        };

        $validated = $request->validate([
            'home.hero_badge' => ['nullable', 'string', 'max:150'],
            'home.hero_title' => ['nullable', 'string', 'max:300'],
            'home.hero_subtitle' => ['nullable', 'string', 'max:600'],
            'home.hero_image' => ['nullable', 'string', 'max:500', function ($attribute, $value, $fail) use ($validUrl) {
                if (! $validUrl($value)) {
                    $fail('URL tidak valid.');
                }
            }],
            'home.cta_primary_label' => ['nullable', 'string', 'max:30'],
            'home.cta_primary_url' => ['nullable', 'string', 'max:500', function ($attribute, $value, $fail) use ($validUrl) {
                if (! $validUrl($value)) {
                    $fail('URL tidak valid.');
                }
            }],
            'home.cta_secondary_label' => ['nullable', 'string', 'max:30'],
            'home.cta_secondary_url' => ['nullable', 'string', 'max:500', function ($attribute, $value, $fail) use ($validUrl) {
                if (! $validUrl($value)) {
                    $fail('URL tidak valid.');
                }
            }],
            'home.intro_image' => ['nullable', 'string', 'max:500', function ($attribute, $value, $fail) use ($validUrl) {
                if (! $validUrl($value)) {
                    $fail('URL tidak valid.');
                }
            }],
            'home.intro_title' => ['nullable', 'string', 'max:150'],
            'home.intro_body' => ['nullable', 'string', 'max:1200'],
            'home.intro_quote' => ['nullable', 'string', 'max:120'],
        ]);

        foreach ($validated['home'] ?? [] as $k => $v) {
            SiteSetting::setValue('home.'.$k, $v);
        }

        Cache::forget('home_site_settings');

        return redirect()->route('admin.appearance.home')->with('status', 'Perubahan landing page berhasil disimpan.');
    })->name('admin.appearance.home.save');
    Route::resource('programs', App\Http\Controllers\Admin\ProgramController::class)->names('admin.programs');
});

Route::prefix('member')->middleware(['auth', 'role:member,super_admin,org_admin'])->group(function () {
    Route::view('/dashboard', 'member.dashboard')->name('member.dashboard');
    Route::view('/card', 'member.card')->name('member.card');
    Route::get('/profile', function () {
        $user = Auth::user();
        $member = Member::query()->with('category')->where('user_id', $user->id)->first();

        return view('member.profile', compact('user', 'member'));
    })->name('member.profile');
    Route::post('/profile', function (Request $request) {
        $user = $request->user();
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'phone' => ['nullable', 'string', 'max:30'],
            'organization' => ['nullable', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'] ?? null;
        $user->organization = $validated['organization'] ?? null;
        if (($validated['password'] ?? '') !== '') {
            $user->password = Hash::make($validated['password']);
        }
        $user->save();

        Member::query()
            ->where('user_id', $user->id)
            ->update(['name' => $validated['name']]);

        return redirect()->route('member.profile')->with('status', 'Profil berhasil disimpan.');
    })->name('member.profile.save');
});

Route::middleware('auth')->group(function () {
    Route::view('/notifications', 'notifications.index')->name('notifications.index');
});

Route::prefix('api/v1/charts')->group(function () {
    Route::get('/members-growth', function () {
        $series = Cache::remember('chart_members_growth', 60, function () {
            $labels = [];
            $data = [];
            for ($i = 5; $i >= 0; $i--) {
                $month = now()->subMonths($i);
                $labels[] = $month->format('M Y');
                $data[] = Member::whereMonth('created_at', $month->month)->whereYear('created_at', $month->year)->count();
            }

            return compact('labels', 'data');
        });

        return response()->json($series);
    });
    Route::get('/event-participation', function () {
        $series = Cache::remember('chart_event_participation', 60, function () {
            $events = Event::withCount('registrations')->orderByDesc('start_at')->limit(3)->get();

            return [
                'labels' => $events->pluck('title')->toArray(),
                'data' => $events->pluck('registrations_count')->toArray(),
            ];
        });

        return response()->json($series);
    });
});
