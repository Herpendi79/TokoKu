<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiModel extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'transaksi';

    // Primary key
    protected $primaryKey = 'transaksi_id';

    public $incrementing = true;

    protected $keyType = 'int';

    // Kolom yang bisa diisi mass assignment
    protected $fillable = [
        'user_id',
        'id',         
        'order_id',
        'price',
        'status',
        'snap_token',
    ];

    // Relasi ke tabel User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    // Kalau id itu foreign key ke Produk
    public function produk()
    {
        return $this->belongsTo(ProdukModel::class, 'id', 'id');
    }
}
