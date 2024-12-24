<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authentication;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authentication
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    public const ROLE_STUDENT = 'student';
    public const ROLE_MANAGER = 'manager';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'avatar',
        'role',
        'status',
        'email_verified_at',
        'phone_verified_at',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'password',
    ];

    
    
   
}
