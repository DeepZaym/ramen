<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    protected $table = "tb_reviews";

    protected $primaryKey = 'reviews_id';

    protected $fillable = ['reviews_id', 'rating', 'comment'];

    public function users() {
        return $this->belongsTo(Users::class);
    }
    
    public function menu() {
        return $this->belongsTo(Menu::class);
    }
    
}
