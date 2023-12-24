<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_buah', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('buah_id')->unsigned();
            // $table->integer('buah_id');
            $table->float('luas_lahan');
            $table->float('produksi');
            $table->float('produktivitas');
            $table->integer('tahun');
            $table->foreign('buah_id')->references('id')->on('buah')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_buah');
    }
};
