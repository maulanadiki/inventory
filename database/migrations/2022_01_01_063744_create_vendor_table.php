<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor', function (Blueprint $table) {
            $table->id();
            $table->string('kode_vendor',6);
            $table->string('nik',16);
            $table->string('npwp',16);
            $table->string('nama_pemilik',20);
            $table->string('nama_vendor',20);
            $table->string('telp',12);
            $table->string('alamat',100);
            $table->string('bank',20);
            $table->string('norek',12);
            $table->string('f_nik',100);
            $table->string('f_npwp',100);
            $table->string('f_tabungan',100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendor');
    }
}
