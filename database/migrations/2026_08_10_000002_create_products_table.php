<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique()->nullable();
            $table->integer('price');
            $table->string('category')->default('Bubur');
            $table->string('age_group')->default('6+ Bulan');
            $table->text('ingredients')->nullable();
            $table->integer('stock')->default(0);
            $table->integer('initial_stock')->default(0);
            $table->string('image')->nullable();
            $table->string('status')->default('Aktif');
            $table->integer('custom_points')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
