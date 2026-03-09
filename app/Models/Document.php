<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Document extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title','slug','category_id','visibility','role','path','mime','size'];

    public function category()
    {
        return $this->belongsTo(DocumentCategory::class, 'category_id');
    }

    protected static function booted(): void
    {
        static::creating(function ($doc) {
            if (empty($doc->slug)) {
                $doc->slug = Str::slug($doc->title).'-'.Str::random(6);
            }
        });
    }
}

