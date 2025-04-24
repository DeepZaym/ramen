<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders_Item extends Model
{
    protected $table = "tb_orders_item";

    protected $primaryKey = 'orders_item_id';

    protected $fillable = ['orders_item_id', 'quantity'];

    public function orders() {
        return $this->belongsTo(Orders::class);
    }

    public function menu() {
        return $this->belongsTo(Menu::class);
    }
}
