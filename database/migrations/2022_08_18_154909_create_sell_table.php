<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sell', function (Blueprint $table) {
            $table->id();
            $table->string('invoice',30);
            $table->string('nama_pelanggan',20);
            $table->string('alamat_pelanggan',100);
            $table->string('telp',12);
            $table->date('tgl_jual');
            $table->string('market_place',20);
            $table->string('grandtotal',10);
            $table->string('email_karyawan');
            $table->string('bukti_pembelian',100);
            $table->string('stat_keluar',8);
            $table->string('stat_sell',8);
            $table->string('bukti_resi',100);
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
        Schema::dropIfExists('sell');
    }
};