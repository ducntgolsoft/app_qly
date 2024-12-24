<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    use HasFactory;
    protected $table = 'password_resets';
    protected $primaryKey = 'email';
    protected $fillable = [
        'email',
        'token',
        'phone',
        'code'
    ];

    protected $casts = [
        'email' => 'string'
    ];

    public $timestamps = false;
}
