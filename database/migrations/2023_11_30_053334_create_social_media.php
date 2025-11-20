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
        Schema::create('social_media', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('user_type')->nullable()->comment("1 = admin, 2 = writer, 3 = user");
            $table->Text('whatsapp')->default('#');
            $table->Text('whatsapp_status')->default(0)->comment('0 = InActive, 1 = Active');
            $table->Text('telegram')->default('#');
            $table->Text('telegram_status')->default(0)->comment('0 = InActive, 1 = Active');
            $table->Text('youtube')->default('#');
            $table->Text('youtube_status')->default(0)->comment('0 = InActive, 1 = Active');
            $table->Text('linkedin')->default('#');
            $table->Text('linkedin_status')->default(0)->comment('0 = InActive, 1 = Active');
            $table->Text('x')->default('#');
            $table->Text('x_status')->default(0)->comment('0 = InActive, 1 = Active');
            $table->Text('facebook')->default('#');
            $table->Text('facebook_status')->default(0)->comment('0 = InActive, 1 = Active');
            $table->Text('instagram')->default('#');
            $table->Text('instagram_status')->default(0)->comment('0 = InActive, 1 = Active');
            $table->Text('thread')->default('#');  
            $table->Text('thread_status')->default(0)->comment('0 = InActive, 1 = Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_media');
    }
};
