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
        Schema::create('pdf_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pdf_page_id');
            $table->Text('short_description')->nullable();
            $table->TinyInteger('file_status')->default('1')->comment('0 = InActive, 1 = Active');
            $table->String('pdf_file')->nullable();
            $table->String('thumbnail')->nullable();
            $table->Integer('downloads')->default('0'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pdf_files');
    }
};
