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
        Schema::table('bookings', function (Blueprint $table) {
            $table->text('review')->nullable()->after('payment_status');
            $table->tinyInteger('sentiment')->nullable()->comment('1: Not Satisfied, 2: Neutral, 3: Satisfied, 4: Very Satisfied')->after('review');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['review', 'sentiment']);
        });
    }
};
