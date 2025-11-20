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
        Schema::table('advertisements', function (Blueprint $table) {
            $table->String('email')->nullable()->after('price');
            $table->date('reminder_date')->nullable()->after('email');
            $table->Integer('reminder_count')->nullable()->after('reminder_date');
            $table->TinyInteger('running_status')->nullable()->after('reminder_count')->comment("0 = waiting, 1 = running, 2 = ended ");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('advertisements', function (Blueprint $table) {
            //
        });
    }
};
