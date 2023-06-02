<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pr extends Model
{
    use HasFactory;
    protected $table ='pr';
    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = [
        'kode_vendor',
        'nopo',
        'statpo',
        'statpay',
        'statpr',
        'created_at',
        'updated_at'
    ];
}
