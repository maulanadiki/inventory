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
        Schema::create('selldetail', function (Blueprint $table) {
            $table->id();
            $table->string('invoice',30);
            $table->string('kode_barang',6);
            $table->string('qty',3);
            $table->string('subtotal',10);
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
        Schema::dropIfExists('selldetail');
    }
};