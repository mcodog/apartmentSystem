<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalyticsTable extends Migration
{
    public function up()
    {
        Schema::create('analytics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->decimal('electricity_amount_due', 10, 2)->default(0);
            $table->decimal('water_amount_due', 10, 2)->default(0);
            $table->decimal('rent_amount', 10, 2)->default(0);
            $table->decimal('overall_due', 10, 2)->default(0);
            $table->enum('paid_status', ['paid', 'unpaid'])->default('unpaid');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('analytics');
    }
}
