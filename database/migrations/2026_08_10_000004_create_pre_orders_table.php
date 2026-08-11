<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pre_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->nullable()->constrained('members')->nullOnDelete();
            $table->foreignId('outlet_id')->constrained('outlets')->cascadeOnDelete();
            $table->string('customer_name');
            $table->string('whatsapp');
            $table->integer('total_amount')->default(0);
            $table->string('pay_method')->default('Transfer');
            $table->boolean('is_paid')->default(false);
            $table->boolean('is_taken')->default(false);
            $table->string('cancel_status')->nullable();
            $table->text('cancel_reason')->nullable();
            $table->integer('points_awarded')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pre_orders');
    }
};
