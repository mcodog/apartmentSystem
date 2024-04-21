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
        Schema::create('billing', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->unsignedBigInteger('tenant_id')->nullable(true);
            $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('set null');
            $table->unsignedBigInteger('apartment_id')->nullable(true);
            $table->foreign('apartment_id')->references('id')->on('apartment')->onDelete('set null');
            $table->unsignedBigInteger('electricity_id')->nullable(true);
            $table->foreign('electricity_id')->references('id')->on('electricity')->onDelete('set null');
            $table->unsignedBigInteger('water_id')->nullable(true);
            $table->foreign('water_id')->references('id')->on('water')->onDelete('set null');
            $table->double('full_amount');
            $table->string('date_paid');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('billing');
    }
};
