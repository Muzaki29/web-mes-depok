<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'slug', 'description', 'thumbnail', 'category', 'start_at', 'end_at', 'location', 'capacity', 'is_public'];

    protected $casts = ['start_at' => 'datetime', 'end_at' => 'datetime', 'is_public' => 'boolean'];

    protected static function booted(): void
    {
        static::creating(function ($event) {
            if (empty($event->slug)) {
                $event->slug = \Illuminate\Support\Str::slug($event->title).'-'.\Illuminate\Support\Str::random(6);
            }
        });
    }

    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }
}
