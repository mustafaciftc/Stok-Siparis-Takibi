<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public function isAdmin()
    {
        return $this->is_admin;
    }
    /**
     * Kitle atanabilir (mass assignable) özellikler.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * JSON dönüşümünde gizlenecek alanlar.
     *
     * @var array<int, string>
     */

}