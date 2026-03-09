<?php

namespace App\Http\Controllers\PublicSite;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function show($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        return view('public.events.show', compact('event'));
    }

    public function register(Request $request, $slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'institution' => 'nullable|string|max:255',
        ]);

        // Check capacity
        if ($event->capacity && $event->registrations()->count() >= $event->capacity) {
            return back()->with('error', 'Mohon maaf, kuota pendaftaran sudah penuh.');
        }

        // Check existing registration
        $existing = EventRegistration::where('event_id', $event->id)
            ->where('email', $validated['email'])
            ->exists();

        if ($existing) {
            return back()->with('error', 'Email ini sudah terdaftar untuk acara tersebut.');
        }

        EventRegistration::create([
            'event_id' => $event->id,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'institution' => $validated['institution'] ?? null,
            'token' => Str::random(32),
            'status' => 'registered',
        ]);

        return back()->with('status', 'Pendaftaran berhasil! Tiket/Konfirmasi akan dikirim ke email Anda.');
    }
}
