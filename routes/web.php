<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;
use App\Models\Member;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\Document;
use App\Models\Article;
use App\Models\Partner as PartnerModel;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicSite\MembershipController as PublicMembershipController;
use App\Http\Controllers\PublicSite\ArticleController as PublicArticleController;
use App\Http\Controllers\PublicSite\DocumentController as PublicDocumentController;
use App\Http\Controllers\PublicSite\ContactController as PublicContactController;
use App\Http\Controllers\PublicSite\EventController as PublicEventController;
use App\Http\Controllers\PublicSite\ProgramController as PublicProgramController;

Route::get('/', function () {
    $metrics = Cache::remember('home_metrics', 600, function () {
        return [
            'members' => Member::count(),
            'partners' => PartnerModel::count(),
            'events_this_year' => Event::whereYear('start_at', now()->year)->count(),
        ];
    });
    $upcomingEvents = Cache::remember('home_upcoming_events', 600, fn() => Event::where('start_at','>=', now())->orderBy('start_at')->limit(5)->get());
    $latestArticles = Cache::remember('home_latest_articles', 600, fn() => Article::where('status','published')->orderByDesc('published_at')->limit(5)->get());
    $partners = Cache::remember('home_partners', 600, fn() => PartnerModel::orderBy('name')->limit(8)->get());
    return view('public.home', compact('metrics','upcomingEvents','latestArticles','partners'));
})->name('home');
Route::get('/news', function (\Illuminate\Http\Request $request) {
    $query = Article::where('status','published');
    
    if ($request->has('q')) {
        $search = $request->q;
        $query->where(function($q) use ($search) {
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

Route::middleware('guest')->group(function(){
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:10,1');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
    Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');
});
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::prefix('admin')->middleware(['auth','role:super_admin,org_admin'])->group(function () {
    Route::get('/dashboard', function () {
        $totalMembers = Cache::remember('dash_total_members', 60, fn() => Member::count());
        $upcomingEvents = Cache::remember('dash_upcoming_events', 60, fn() => Event::where('start_at','>=',now())->count());
        $activeConsultations = Cache::remember('dash_active_consultations', 60, fn() => \App\Models\Consultation::whereIn('status',['assigned','scheduled'])->count());
        $documentsCount = Cache::remember('dash_documents_count', 60, fn() => Document::count());
        $recentMembers = Member::with('category')->latest()->limit(5)->get();
        $recentDocuments = Document::latest()->limit(5)->get();
        $latestRegistrations = EventRegistration::with('event')->latest()->limit(5)->get();
        $recentAnnouncements = collect([ (object)['title'=>'Policy Update'], (object)['title'=>'Maintenance Window'] ]);
        $activities = collect([
            'New member registered',
            'Document uploaded',
            'Event created',
            'Consultation scheduled',
        ]);
        return view('admin.dashboard', compact(
            'totalMembers','upcomingEvents','activeConsultations','documentsCount',
            'recentMembers','recentDocuments','latestRegistrations','recentAnnouncements','activities'
        ));
    })->name('admin.dashboard');
    Route::view('/members', 'admin.members.index')->name('admin.members');
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
    Route::view('/settings', 'admin.settings.index')->name('admin.settings');
    Route::resource('programs', App\Http\Controllers\Admin\ProgramController::class)->names('admin.programs');
});

Route::prefix('member')->middleware('role:member,super_admin,org_admin')->group(function () {
    Route::view('/dashboard', 'member.dashboard')->name('member.dashboard');
    Route::view('/card', 'member.card')->name('member.card');
});

Route::prefix('api/v1/charts')->group(function () {
    Route::get('/members-growth', function () {
        $series = Cache::remember('chart_members_growth', 60, function () {
            $labels = [];
            $data = [];
            for ($i=5; $i>=0; $i--) {
                $month = now()->subMonths($i);
                $labels[] = $month->format('M Y');
                $data[] = Member::whereMonth('created_at', $month->month)->whereYear('created_at', $month->year)->count();
            }
            return compact('labels','data');
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
