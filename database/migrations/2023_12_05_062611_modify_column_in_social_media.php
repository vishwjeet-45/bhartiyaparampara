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
            $table->string('whatsapp_status')->nullable()->change();   
            $table->string('telegram_status')->nullable()->change();   
            $table->string('youtube_status')->nullable()->change();   
            $table->string('linkedin_status')->nullable()->change();   
            $table->string('x_status')->nullable()->change();   
            $table->string('facebook_status')->nullable()->change();   
            $table->string('instagram_status')->nullable()->change();   
            $table->string('thread_status')->nullable()->change();   
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
