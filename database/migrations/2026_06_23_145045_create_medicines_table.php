<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('generic_name');
            $table->string('sku')->unique();
            $table->foreignId('category_id')->constrained('medicine_categories');
            $table->string('manufacturer')->nullable();
            $table->string('unit');
            $table->integer('stock_quantity')->default(0);
            $table->decimal('unit_price', 10, 2)->default(0);
            $table->date('expiry_date');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medicines');
    }
};
