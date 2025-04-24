<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = "tb_orders";

    protected $primaryKey = 'orders_id';

    protected $fillable = ['orders_id', 'orders_nama', 'total_price', 'status', 'delivery_address'];

    public function users() {
        return $this->belongsTo(Users::class);
    }

}
