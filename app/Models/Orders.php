<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{

 public function user()
    {
        return $this->belongsTo(\App\Models\Users::class, 'users_id', 'users_id');
    }

    public function ordersItems()
    {
        return $this->hasMany(Orders_Item::class, 'orders_item_id', 'orders_item_id');
    }

    protected $table = "tb_orders";

    protected $primaryKey = 'orders_id';

    protected $fillable = ['orders_id', 'orders_nama', 'total_price', 'status', 'delivery_address'];

}
