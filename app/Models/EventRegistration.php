<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    use HasFactory;

    protected $fillable = ['event_id', 'member_id', 'name', 'email', 'token', 'status'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
