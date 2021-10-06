<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePopulationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('populations', function (Blueprint $table) {
            $table->id();
            $table->string('satuan_kerja')->nullable();
            $table->string('nama_wilayah');
            $table->bigInteger('jumlah_penduduk');
            $table->bigInteger('pria');
            $table->bigInteger('wanita');
            $table->bigInteger('0_18')->nullable();
            $table->bigInteger('18_40')->nullable();
            $table->bigInteger('40_45')->nullable();
            $table->bigInteger('55')->nullable();
            $table->integer('tahun');
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
        Schema::dropIfExists('populations');
    }
}
