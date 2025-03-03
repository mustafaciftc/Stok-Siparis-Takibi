<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siparis_id')->constrained('siparis');
            $table->decimal('amount', 10, 2);
            $table->string('provider');
            $table->string('status');
            $table->string('transaction_id')->nullable();
            $table->string('authorization_code')->nullable();
            $table->string('reference_number')->nullable();
            $table->string('reference')->nullable();
            $table->text('error_message')->nullable();
            $table->text('response_data')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
