<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = "tb_menu";

    protected $primaryKey = 'menu_id';

    protected $fillable = ['menu_id', 'menu_nama', 'menu_deskripsi', 'menu_harga', 'status'];
}
