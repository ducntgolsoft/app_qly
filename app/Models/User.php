<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authentication;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authentication
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    public const ROLE_STUDENT = 'student';
    public const ROLE_MANAGER = 'admin';
    protected $fillable = [
        'username',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    
    public function isStudent(): bool
    {
        return $this->role === self::ROLE_STUDENT;
    }

    public function isManager(): bool
    {
        return $this->role === self::ROLE_MANAGER;
    }

    public function isAllowedTo(string $role): bool
    {
        return $this->role === $role;
    }

    public function isNotStudent(): bool
    {
        return !$this->isStudent();
    }

    public function isNotManager(): bool
    {
        return !$this->isManager();
    }

    public function student(): HasOne
    {
        return $this->hasOne(Student::class);
    }
}