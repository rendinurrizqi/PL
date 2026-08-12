<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        try {
            DB::statement('ALTER TABLE products MODIFY image LONGTEXT NULL');
        } catch (\Throwable $e) {
            try {
                Schema::table('products', function (Blueprint $table) {
                    $table->longText('image')->nullable()->change();
                });
            } catch (\Throwable $ex) {
                // ignore
            }
        }
    }

    public function down(): void
    {
    }
};
