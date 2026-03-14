<?php

namespace App\Http\Controllers\PublicSite;

use App\Http\Controllers\Controller;
use App\Models\MembershipApplication;
use App\Notifications\MembershipApplicationSubmitted;
use App\Services\CaptchaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class MembershipController extends Controller
{
    public function create()
    {
        $captcha = CaptchaService::generate();
        return view('public.membership', compact('captcha'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'captcha' => ['required', function ($attribute, $value, $fail) {
                if (!CaptchaService::verify($value)) {
                    $fail('Kode keamanan salah. Silakan coba lagi.');
                }
            }],
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'organization' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:2000',
        ]);
        $app = MembershipApplication::create($data);

        try {
            $adminEmail = config('mail.admin_address') ?? config('mail.from.address') ?? 'admin@example.com';
            Notification::route('mail', $adminEmail)
                ->notify(new MembershipApplicationSubmitted($app));
        } catch (\Exception $e) {
            // Log error but continue to show success message to user
            \Illuminate\Support\Facades\Log::error('Failed to send membership notification: ' . $e->getMessage());
        }

        return redirect()->route('membership')->with('status','Pendaftaran berhasil dikirim. Kami akan menghubungi Anda.');
    }
}

