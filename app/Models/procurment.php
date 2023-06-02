<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class procurment extends Model
{
   
    use HasFactory;
    protected $table ='procurment';
    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = [
        'nopo',
        'Kode_vendor',
        'status_pengajuan',
        'status_bayar',
        'bukti_bayar',
        'created_at',
        'updated_at'
    ];

    public function detailpo()
    {
        return $this->hasMany('App\detailprocurment');
    }
}
