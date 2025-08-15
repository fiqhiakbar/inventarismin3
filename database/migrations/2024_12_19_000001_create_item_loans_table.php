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
        Schema::create('item_loans', function (Blueprint $table) {
            $table->id();
            $table->string('borrower_name');
            $table->string('phone_number');
            $table->string('item_name');
            $table->string('item_code');
            $table->date('loan_date');
            $table->date('return_date')->nullable();
            $table->enum('status', ['masuk', 'keluar'])->default('masuk');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_loans');
    }
};
