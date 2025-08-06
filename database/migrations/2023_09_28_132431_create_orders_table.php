<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private string $table = 'orders';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('order_date');
            $table->integer('total_amount');
            $table->string('payment_method')->nullable();
            $table->string('transfer_proof_path')->nullable();
            $table->string('order_code')->unique()->nullable();
            $table->string('status');
            $table->unsignedBigInteger('address_id')->nullable();
            $table->timestamps();
            $table->foreign('address_id')->references('id')->on('addresses')
            ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table($this->table, function (Blueprint $table) {
            $table->renameColumn('order_code', 'order_id');
        });
        Schema::dropIfExists($this->table);
    }
};
