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
        Schema::table('siparis', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('customer_name');
            $table->string('email')->nullable()->after('phone');
            $table->text('notes')->nullable()->after('address');
            $table->string('payment_status')->default('pending')->after('payment_method');
            $table->string('order_status')->default('processing')->after('payment_status');
            $table->decimal('shipping_cost', 8, 2)->default(0)->after('total_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siparis', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'email',
                'notes',
                'payment_status',
                'order_status',
                'shipping_cost'
            ]);
        });
    }
};
