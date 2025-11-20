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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->Integer('post_by')->comment('user id who create this post');
            $table->string('meta_title')->nullable();
            $table->Text('meta_keyword')->nullable();
            $table->Text('meta_description')->nullable();
            $table->string('slug');
            $table->Integer('main_category_id')->nullable();
            $table->Integer('category_id')->nullable();
            $table->Integer('sub_category_id')->nullable();
            $table->Text('post_data');
            $table->Integer('post_status')->comment('0 = disabled, 1 =  active or enable');
            $table->Text('tags')->nullable();
            $table->Integer('post_approval_status')->nullable()->comment('0 = disApproved, 1 = approved, 2 = pending');
            $table->Text('approval_comment')->nullable();
            $table->String('post_language')->nullable();
            $table->BigInteger('views')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
