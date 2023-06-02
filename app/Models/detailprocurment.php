<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailprocurment extends Model
{
    use HasFactory;
    protected $table ='detailprocurment';
    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = [
        'no_po',
        'kode_barang',
        'qty',
        'harga_beli',
        'subtotal'
    ];

    public function Goods()
    {
        return $this->belongsTo(Goods::class);
    }
    public function stock()
    {
        return $this->belongsTo(stock::class);
    }
}
