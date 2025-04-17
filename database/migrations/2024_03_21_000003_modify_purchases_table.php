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
        Schema::table('purchases', function (Blueprint $table) {
            // Add new columns if they don't exist
            if (!Schema::hasColumn('purchases', 'product_id')) {
                $table->foreignId('product_id')->constrained()->onDelete('cascade');
            }
            if (!Schema::hasColumn('purchases', 'supplier_id')) {
                $table->foreignId('supplier_id')->constrained()->onDelete('cascade');
            }
            if (!Schema::hasColumn('purchases', 'quantity')) {
                $table->integer('quantity');
            }
            if (!Schema::hasColumn('purchases', 'unit_price')) {
                $table->decimal('unit_price', 10, 2);
            }
            if (!Schema::hasColumn('purchases', 'total_price')) {
                $table->decimal('total_price', 10, 2);
            }
            if (!Schema::hasColumn('purchases', 'purchase_date')) {
                $table->date('purchase_date');
            }
            if (!Schema::hasColumn('purchases', 'status')) {
                $table->enum('status', ['pending', 'completed', 'cancelled'])->default('pending');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('purchases', function (Blueprint $table) {
            // Drop new columns
            $table->dropForeign(['product_id']);
            $table->dropForeign(['supplier_id']);
            $table->dropColumn(['product_id', 'supplier_id', 'quantity', 'unit_price', 'total_price', 'purchase_date', 'status']);
        });
    }
}; 