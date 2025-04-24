<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    protected $table = "tb_payments";

    protected $primaryKey = 'payments_id';

    protected $fillable = ['payments_id', 'metode_pembayaran', 'status'];

    public function orders() {
        return $this->belongsTo(Orders::class);
    }
    
}
