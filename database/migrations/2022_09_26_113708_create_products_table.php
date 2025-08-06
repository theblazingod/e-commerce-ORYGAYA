<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private string $table = 'products';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable($this->table)) {
            Schema::create($this->table, function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->decimal('price', 10, 2);
                $table->text('description')->nullable();
                $table->foreignId('category_id')->nullable()->constrained('product_categories')->onUpdate('cascade')->onDelete('set null');
                $table->boolean('is_variable')->default(0);
                $table->boolean('is_featured')->default(0);
                $table->string('product_image');
                $table->integer('inventory_count')->default(0);
                $table->integer('low_stock_threshold')->nullable();
                $table->string('size')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
};
