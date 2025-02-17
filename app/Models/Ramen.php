<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ramen extends Model
{
    protected $table = "tb_ramen";

    protected $primaryKey = 'ramen_id';

    protected $fillable = ['ramen_id', 'ramen_nama', 'ramen_deskripsi', 'ramen_harga'];
}