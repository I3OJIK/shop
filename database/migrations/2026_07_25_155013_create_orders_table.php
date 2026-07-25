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
            $table->foreignId('user_id')->constrained('users')->restrictOnDelete();
            $table->enum('status', ['pending', 'paid', 'shipped', 'completed', 'cancelled'])->default('pending');
            $table->decimal('total_price', 10, 2)->nullable(false);
            $table->string('phone'); 
            $table->string('address_text');                     // строка адреса
            $table->string('apartment_number')->nullable();     // номер кв
            $table->string('doorphone')->nullable();            // домофон
            $table->string('entrance')->nullable();             // подьезд
            $table->string('floor')->nullable();                // этаж
            $table->string('comment')->nullable();
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
