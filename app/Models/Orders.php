<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    // Nama tabel
    protected $table = "tb_orders";

    // Primary key kustom
    protected $primaryKey = 'orders_id';

    // Jika primary key bukan integer autoincrement, ubah ini
    public $incrementing = false;
    protected $keyType = 'string'; // ubah sesuai kebutuhan, misalnya UUID

    // Fillable fields
    protected $fillable = [
        'orders_id',
        'orders_nama',
        'total_price',
        'status',
        'delivery_address',
        'users_id' // penting: agar relasi belongsTo ke Users bisa digunakan
    ];

    // Relasi ke Users
    public function user()
    {
        return $this->belongsTo(\App\Models\Users::class, 'users_id', 'users_id');
    }

    // Relasi ke Orders_Item
    public function ordersItems()
    {
        return $this->hasMany(\App\Models\Orders_Item::class, 'orders_id', 'orders_id');
        // perbaikan: foreign key dan local key diubah agar masuk akal
    }
}
