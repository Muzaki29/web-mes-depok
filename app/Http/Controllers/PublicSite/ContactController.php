<?php

namespace App\Http\Controllers\PublicSite;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Services\CaptchaService;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function create()
    {
        $captcha = CaptchaService::generate();

        return view('public.contact', compact('captcha'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'captcha' => ['required', function ($attribute, $value, $fail) {
                if (! CaptchaService::verify($value)) {
                    $fail('Kode keamanan salah. Silakan coba lagi.');
                }
            }],
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        ContactMessage::create($validated);

        return back()->with('status', 'Pesan Anda telah terkirim. Terima kasih telah menghubungi kami.');
    }
}
