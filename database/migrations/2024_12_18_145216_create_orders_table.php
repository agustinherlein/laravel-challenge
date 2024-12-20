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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamp('paid_at')->nullable();
            $table->decimal('total_amount', 15, 2);
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')->references('id')->on('enum_order_status');
            $table->foreignId('client_id')->constrained();
            $table->foreignId('address_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
