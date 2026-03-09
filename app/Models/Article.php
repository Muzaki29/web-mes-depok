<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['title','slug','thumbnail','excerpt','body','status','published_at','author_id'];
    protected $casts = ['published_at' => 'datetime'];

    protected static function booted(): void
    {
        static::creating(function ($a) {
            if (empty($a->slug)) {
                $a->slug = Str::slug($a->title).'-'.Str::random(6);
            }
        });
    }
}
