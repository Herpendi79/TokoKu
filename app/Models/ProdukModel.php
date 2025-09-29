<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukModel extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;
    
    protected $table = 'produk';
    protected $fillable = [
        'foto_produk',
        'nama_produk',
        'deskripsi_produk',
        'harga_produk',
        'stock_produk',
    ];
}
