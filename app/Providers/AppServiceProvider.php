<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('download-document', function (?object $user, Document $document): bool {
            $role = $user->role ?? 'public_user';
            if ($document->visibility === 'public') {
                return true;
            }
            if ($document->visibility === 'member') {
                return Auth::check();
            }
            if ($document->visibility === 'role') {
                return Auth::check() && $role === $document->role;
            }
            if ($document->visibility === 'private') {
                return in_array($role, ['super_admin','org_admin'], true);
            }
            return false;
        });
    }
}
