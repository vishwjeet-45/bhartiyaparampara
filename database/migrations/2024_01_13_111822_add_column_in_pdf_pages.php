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
        Schema::table('pdf_pages', function (Blueprint $table) {
            $table->Text('meta_title_en')->after('meta_description_hi')->nullable();
            $table->Text('meta_description_en')->after('meta_title_en')->nullable();
            $table->Text('meta_keyword_en')->after('meta_description_en')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pdf_pages', function (Blueprint $table) {
            //
        });
    }
};
