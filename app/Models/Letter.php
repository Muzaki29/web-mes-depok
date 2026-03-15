<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Letter extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['template_id', 'direction', 'number', 'subject', 'body'];

    public function template()
    {
        return $this->belongsTo(LetterTemplate::class, 'template_id');
    }
}
