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
            $table->tinyInteger('page_status')->default('1')->after('views')->comment('0 = InActive, 1 = Active');
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
