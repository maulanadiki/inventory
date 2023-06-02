<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employe extends Model
{
    use HasFactory;
    protected $table ='employe';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = [
        'id',
        'nik',
        'npwp',
        'nama',
        'tempat',
        'tanggal',
        'kelamin',
        'telp',
        'email',
        'alamat',
        'bank',
        'norek',
        'f_nik',
        'f_npwp',
        'f_tabungan',
        'akses'

    ];
}
