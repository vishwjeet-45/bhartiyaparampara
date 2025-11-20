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
            $table->renameColumn('meta_title', 'meta_title_hi');
            $table->renameColumn('meta_keyword', 'meta_keyword_hi');
            $table->renameColumn('meta_description', 'meta_description_hi');
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
