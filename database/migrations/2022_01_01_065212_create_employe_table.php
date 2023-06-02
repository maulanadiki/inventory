<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employe', function (Blueprint $table) {
            $table->id();
            $table->string('nik',16);
            $table->string('npwp',16);
            $table->string('nama',20);
            $table->string('tempat',20);
            $table->date('tanggal');
            $table->string('kelamin',2);
            $table->string('telp',13);
            $table->string('email',30);
            $table->string('alamat',100);
            $table->string('bank',30);
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
        Schema::dropIfExists('employe');
    }
}
