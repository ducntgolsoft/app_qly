<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authentication;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authentication
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    public const ROLE_STUDENT = 'student';
    public const ROLE_MANAGER = 'manager';
    public const ROLE_ADMIN = 'admin';
    protected $fillable = [
        'username',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    public function student(): HasOne
    {
        return $this->hasOne(Student::class);
    }
}