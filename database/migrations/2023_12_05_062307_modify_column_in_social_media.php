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
        Schema::table('social_media', function (Blueprint $table) {
            $table->string('whatsapp')->nullable()->change();   
            $table->string('telegram')->nullable()->change();   
            $table->string('youtube')->nullable()->change();   
            $table->string('linkedin')->nullable()->change();   
            $table->string('X')->nullable()->change();   
            $table->string('facebook')->nullable()->change();   
            $table->string('instagram')->nullable()->change();   
            $table->string('thread')->nullable()->change();   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('social_media', function (Blueprint $table) {
            //
        });
    }
};
