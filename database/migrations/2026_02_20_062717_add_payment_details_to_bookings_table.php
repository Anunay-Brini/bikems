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
            $table->decimal('total_amount', 10, 2)->nullable()->after('status');
            $table->decimal('amount_paid', 10, 2)->default(0)->after('total_amount');
            $table->decimal('damage_charges', 10, 2)->default(0)->after('amount_paid');
            $table->string('payment_status')->default('pending')->after('damage_charges'); // pending, partial, full
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            //
        });
    }
};
