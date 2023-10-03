<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Food;
use App\Models\ValueTypes;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('food_raw_materials', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Food::class);
            $table->string('name');
            $table->integer('value');
            $table->foreignIdFor(ValueTypes::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_raw_materials');
    }
};
