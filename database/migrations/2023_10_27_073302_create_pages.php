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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('meta_title')->nullable();
            $table->Text('meta_keyword')->nullable();
            $table->Text('meta_description')->nullable();
            $table->string('slug')->nullable();
            $table->Integer('main_category_id')->nullable();
            $table->Integer('category_id')->nullable();
            $table->Integer('sub_category_id')->nullable();
            $table->Text('page_data')->nullable();
            $table->boolean('page_status')->default(true)->comment('0 = disabled, 1 =  active or enable');
            $table->Text('tags')->nullable();  
            $table->String('page_language')->nullable();
            $table->BigInteger('views')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
