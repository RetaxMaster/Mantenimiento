<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'rol', 'password', 'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function addAdmin() {
        static::create([
            'name' => "Admin",
            "username" => "Admin",
            'email' => "admin@admin.com",
            'rol' => 3,
            'email_verified_at' => now(),
            'password' => Hash::make("asd"),
            'remember_token' => Str::random(10),
        ]);
    }

    // Roles
    
    public function isAdmin() {
        return auth()->user()->rol >= 3;
    }

    public function isPlanificador() {
        return auth()->user()->rol >= 2;
    }

    public function isUsuario() {
        return auth()->user()->rol == 1;
    }
    
    // -> Roles

    // Relaciones
    
    public function mantenimientos() {
        return $this->hasMany(Mantenimientos::class, 'usuario_id');
    }
    
    // -> Relaciones
}