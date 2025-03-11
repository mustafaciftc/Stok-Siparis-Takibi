<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('siparis_detay', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siparis_id');
            $table->unsignedBigInteger('stok_id');
            $table->integer('miktar');
            $table->decimal('fiyat', 10, 2);
            $table->timestamps();
    
            $table->foreign('siparis_id')->references('id')->on('siparis')->onDelete('cascade');
            $table->foreign('stok_id')->references('id')->on('stok')->onDelete('cascade');
        });
    }
};
