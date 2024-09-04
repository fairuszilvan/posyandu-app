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
        Schema::create('periksa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pasien');
            $table->string('kode_periksa');
            $table->string('tensi');     
            $table->integer('bb');          
            $table->integer('suhu_badan');  
            $table->integer('nadi');
            $table->text('keluhan');        
            $table->timestamps();
        
            $table->foreign('id_pasien')
                ->references('id')
                ->on('pasien')
                ->onDelete('cascade');  
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periksa');
    }
};
