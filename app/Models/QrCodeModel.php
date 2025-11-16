<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QrCodeModel extends Model
{
    use HasFactory;

    protected $table = 'qrcode';
    protected $primaryKey = 'id_qr';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'nama_qrcode',
    ];
}
