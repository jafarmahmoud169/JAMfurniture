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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('details');
            $table->string('image');
            $table->boolean('is_trendy')->default(false);
            $table->boolean('is_available')->default(true);
            $table->decimal('price',10,2);
            $table->decimal('discount',8,2)->nullable();
            $table->integer('amount');
            $table->timestamps();

            $table->foreignId('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
