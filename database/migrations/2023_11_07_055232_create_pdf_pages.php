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
        Schema::create('pdf_pages', function (Blueprint $table) {
            $table->id();
            $table->String('page_name')->nullable();
            $table->String('meta_title')->nullable();
            $table->Text('meta_keyword')->nullable();
            $table->Text('meta_description')->nullable();
            $table->Text('short_description')->nullable();
            $table->String('slug')->nullable();
            $table->String('thumbnail_image')->nullable();
            $table->Text('tags')->nullable();
            $table->String('page_language')->nullable();
            $table->Integer('views')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pdf_pages');
    }
};
