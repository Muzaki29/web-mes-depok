<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $fillable = ['requester_name', 'topic', 'status', 'scheduled_at'];

    protected $casts = ['scheduled_at' => 'datetime'];
}
