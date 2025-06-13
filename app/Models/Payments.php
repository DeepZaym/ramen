<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{

    public function orders()
{
    return $this->hasMany(Orders::class, 'orders_id', 'orders_id');
}

    protected $table = "tb_payments";

    protected $primaryKey = 'payments_id';

    protected $fillable = ['orders_id', 'metode_pembayaran', 'status'];
    
}
