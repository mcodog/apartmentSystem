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
        Schema::create('electricity', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id');
            $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('cascade');
            $table->date('date'); 
            $table->double('kwh', 8, 2); // Assuming kWh is a decimal number
            $table->decimal('amount_per_kwh', 10, 2); // Assuming amount is a decimal number
            $table->decimal('amount_due', 10, 2); // Assuming amount is a decimal number
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('electricity');
    }
};
