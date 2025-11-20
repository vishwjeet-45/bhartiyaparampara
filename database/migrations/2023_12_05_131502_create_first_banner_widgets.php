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
        Schema::create('first_banner_widgets', function (Blueprint $table) {
            $table->id();
            $table->Text('image')->nullable();
            $table->Text('title')->nullable();
            $table->Text('url')->nullable();
            $table->TinyInteger('status')->default(1);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('first_banner_widgets');
    }
};
