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
        Schema::create('apartment', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->double('rental_fee');
            $table->unsignedBigInteger('tenant_id')->nullable(true);
            $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('cascade');
            $table->string('date_occupied')->nullable(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apartment');
    }
};
