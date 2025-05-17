<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders_Item extends Model
{

    public function order()
{
    return $this->belongsTo(Orders::class, 'orders_id', 'orders_id');
}

public function menu()
{
    return $this->belongsTo(Menu::class, 'menu_id', 'menu_id');
}

    protected $table = "tb_orders_item";

    protected $primaryKey = 'orders_item_id';

    protected $fillable = ['orders_item_id', 'quantity'];
}
