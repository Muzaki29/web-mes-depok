<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'category_id', 'name', 'membership_no', 'status', 'valid_until'];

    protected $casts = ['valid_until' => 'date'];

    public function category()
    {
        return $this->belongsTo(MemberCategory::class, 'category_id');
    }

    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }
}
