<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    use HasFactory;
    protected $table ='barang';
    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'kode_barang',
        'nama_barang',
        'warna',
        'ukuran',
        'beli',
        'deskripsi',
        'f_barang'
    ];
}
