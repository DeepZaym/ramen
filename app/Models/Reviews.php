<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    public function user()
    {
        return $this->belongsTo(Users::class, 'users_id', 'users_id');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'menu_id');
    }
    
    protected $table = "tb_reviews";
    protected $primaryKey = 'reviews_id';
    protected $fillable = ['reviews_id', 'rating', 'comment', 'users_id', 'menu_id'];

    
}
