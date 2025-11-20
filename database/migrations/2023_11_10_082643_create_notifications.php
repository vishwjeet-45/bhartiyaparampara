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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->Text('title')->nullable();
            $table->Text('description')->nullable();
            $table->Text('notification_type')->nullable()->comment('What type of notification is');
            $table->TinyInteger('notification_status')->comment('0 = InActive, 1 = Active');
            $table->String('notification_source')->nullable()->comment('from where notification is comming like:- cat created, post created');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
