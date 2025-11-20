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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('main_category_id');
			$table->foreign('main_category_id')->references('id')->on('main_categories')->onDelete('restrict');  
            $table->String('category_name')->nullable();
            $table->Integer('category_status')->nullable()->comment('0 = disabled, 1 = active or enabled');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
