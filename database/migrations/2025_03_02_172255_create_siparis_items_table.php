<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiparisItemsTable extends Migration
{
    public function up()
    {
        Schema::create('siparis_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siparis_id');
            $table->unsignedBigInteger('stok_id');
            $table->integer('quantity');
            $table->decimal('price', 8, 2);
            $table->timestamps();

            $table->foreign('siparis_id')->references('id')->on('siparisler')->onDelete('cascade');
            $table->foreign('stok_id')->references('id')->on('stoklar')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('siparis_items');
    }
}