<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    use HasFactory;
    protected $table ='barang';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = [
        'id',
        'kode_barang',
        'kuantitas',
        'created_at',
        'updated_at'
    ];

    public function detailprocurment(){
        return $this->hasMany(detailprocurment::class)->withPivot(['qty'])->withTimeStamps();
    }

    public function selldetail()
    {
        return $this->hasMany(selldetail::class)->withPivot(['qty'])->withTimeStamps();
    }
    public function stock()
    {
        return $this->belongsTo(stock::class);
    }
}
