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
        Schema::table('answers', function (Blueprint $table) {
            $table->tinyInteger('answer_status')->default(1)->after('answer')->comment('0 = InActive, 1 = Active');
            $table->tinyInteger('answer_approval_status')->default(2)->after('answer_status')->comment('0 = not approved, 1 = approved, 2 = pending');
            $table->String('disapprove_comment')->after('answer_approval_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('answers', function (Blueprint $table) {
            //
        });
    }
};
