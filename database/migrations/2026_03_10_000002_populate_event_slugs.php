<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Event;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Ensure Event model is loaded
        if (class_exists(Event::class)) {
            $events = Event::whereNull('slug')->orWhere('slug', '')->get();
            foreach ($events as $event) {
                $slug = Str::slug($event->title);
                $originalSlug = $slug;
                $count = 1;
                while (Event::where('slug', $slug)->where('id', '!=', $event->id)->exists()) {
                    $slug = $originalSlug . '-' . $count++;
                }
                $event->update(['slug' => $slug]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No need to revert
    }
};
