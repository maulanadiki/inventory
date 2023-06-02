<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcurmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procurment', function (Blueprint $table) {
            $table->id();
            $table->string('nopo',13);
            $table->string('Kode_vendor',6);
            $table->string('status_pengajuan',10);
            $table->string('status_bayar',10);
            $table->string('bukti_bayar',100);
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
        Schema::dropIfExists('procurment');
    }
}