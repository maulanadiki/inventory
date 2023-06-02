<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stock extends Model
{
    use HasFactory;
    protected $table ='stockgood';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = [
        'kode_barang',
        'qty',
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

    public function Goods()
    {
        return $this->belongsTo(Goods::class);
    }
}
