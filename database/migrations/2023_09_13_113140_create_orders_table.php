<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Food;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->ForeignIdFor(User::class, 'customer_id');
            $table->ForeignIdFor(Food::class);
            $table->integer('order_quantity');
            $table->decimal('paid_price');
            $table->tinyInteger('status')->default('0');
            // 0 -> preparing, 1 -> out for delivery, 2 -> delivered
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
