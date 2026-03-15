<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\CaptchaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function showLogin(Request $request)
    {
        if (Auth::check()) {
            return $this->redirectByRole();
        }
        $captcha = CaptchaService::generate();

        return view('auth.login', compact('captcha'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
            'captcha' => ['required', function ($attribute, $value, $fail) {
                if (! CaptchaService::verify($value)) {
                    $fail('Jawaban Captcha salah.');
                }
            }],
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return $this->redirectByRole();
        }

        $captcha = CaptchaService::generate();

        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput()->with('captcha', $captcha);
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return $this->redirectByRole();
        }
        $captcha = CaptchaService::generate();

        return view('auth.register', compact('captcha'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'captcha' => ['required', function ($attribute, $value, $fail) {
                if (! CaptchaService::verify($value)) {
                    $fail('Jawaban Captcha salah.');
                }
            }],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'public_user',
        ]);

        Auth::login($user);

        return redirect('/');
    }

    // --- Google Auth ---
    public function redirectToGoogle()
    {
        if (! class_exists('Laravel\Socialite\Facades\Socialite')) {
            return redirect()->route('login')->with('error', 'Fitur Login Google belum tersedia (Library Missing).');
        }
        // Check if config exists
        if (empty(config('services.google.client_id'))) {
            return redirect()->route('login')->with('error', 'Fitur Login Google belum dikonfigurasi.');
        }

        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        if (! class_exists('Laravel\Socialite\Facades\Socialite')) {
            return redirect()->route('login');
        }

        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('email', $googleUser->email)->first();

            if ($user) {
                if (! $user->google_id) {
                    $user->update([
                        'google_id' => $googleUser->id,
                        'avatar' => $googleUser->avatar,
                    ]);
                }
                Auth::login($user);

                return $this->redirectByRole();
            } else {
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'avatar' => $googleUser->avatar,
                    'password' => Hash::make(Str::random(24)), // Random password
                    'role' => 'public_user',
                ]);
                Auth::login($user);

                return redirect('/');
            }
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Gagal login dengan Google.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    protected function redirectByRole()
    {
        $role = Auth::user()->role ?? 'public_user';
        if (in_array($role, ['super_admin', 'org_admin'], true)) {
            return redirect()->route('admin.dashboard');
        }
        if ($role === 'member') {
            return redirect()->route('member.dashboard');
        }

        return redirect('/');
    }
}
