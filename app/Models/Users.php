<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Users extends Authenticatable
{
    use Notifiable;

    protected $table = 'tb_users';
    protected $primaryKey = 'users_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'users_nama', 
        'users_email', 
        'users_password', 
        'users_alamat',
    ];

    protected $hidden = [
        'users_password', 
        'remember_token',
    ];

    // Override the password field for authentication
    public function getAuthPassword() {
        return $this->users_password;
    }

    // Override the username field for authentication
    public function getAuthIdentifierName() {
        return 'users_nama';
    }

    // Override the identifier value for authentication
    public function getAuthIdentifier() {
        return $this->users_nama;
    }

    // Relationships
    public function orders()
    {
        return $this->hasMany(Orders::class, 'users_id', 'users_id');
    }

    public function reviews()
    {
        return $this->hasMany(Reviews::class, 'users_id', 'users_id');
    }
}