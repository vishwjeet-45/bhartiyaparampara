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
        Schema::table('users', function (Blueprint $table) {
            $table->Text('meta_title_hi')->after('bio_en')->nullable();
            $table->Text('meta_description_hi')->after('meta_title_hi')->nullable();
            $table->Text('meta_keyword_hi')->after('meta_description_hi')->nullable();
            $table->Text('meta_title_en')->after('meta_keyword_hi')->nullable();
            $table->Text('meta_description_en')->after('meta_title_en')->nullable();
            $table->Text('meta_keyword_en')->after('meta_description_en')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
