<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{

        public function orders()
    {
        return $this->hasMany(Orders::class, 'users_id', 'users_id');
    }

    protected $table = "tb_users";

    protected $primaryKey = 'users_id';

    protected $fillable = ['users_id', 'users_nama', 'users_email', 'users_password', 'users_alamat'];
}
