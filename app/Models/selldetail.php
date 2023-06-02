<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class selldetail extends Model
{
    use HasFactory;
    protected $table ='selldetail';
    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'invoice',
        'kode_barang',
        'jual',
        'qty',
        'subtotal',
        'created_at',
        'updated_at'];

        public function Goods()
        {
            return $this->belongsTo(Goods::class);
        }
        public function stock()
    {
        return $this->belongsTo(stock::class);
    }
}
