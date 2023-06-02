<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class selling extends Model
{
    use HasFactory;
    protected $table ='sell';
    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = [
        'invoice',
        'nama_pelanggan',
        'alamat_pelanggan',
        'telp',
        'tgl_jual',
        'market_place',
        'grandtotal',
        'email',
        'bukti pembelian',
        'stat_keluar',
        'stat_cell'
    ];

}