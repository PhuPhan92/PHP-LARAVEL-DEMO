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
        Schema::create('productivities', function (Blueprint $table) {
            $table->id();
            $table->string("style");
            $table->string("po");
            $table->integer("product_output");
            $table->float("employee_quantity");
            $table->timestamp("manufacture_date");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productivities');
    }
};
