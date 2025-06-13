<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders_Item extends Model
{

    public function orders()
{
    return $this->belongsTo(Orders::class, 'orders_id', 'orders_id');
}
public $timestamps = true;
public function menu()
{
    return $this->belongsTo(Menu::class, 'menu_id', 'menu_id');
}

    protected $table = "tb_orders_item";

    protected $primaryKey = 'orders_item_id';

    protected $fillable = [
        'orders_id',
        'menu_id',
        'quantity'
    ];
}
