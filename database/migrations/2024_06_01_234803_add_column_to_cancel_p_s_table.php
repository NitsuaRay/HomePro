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
        Schema::table('cancel_p_s', function (Blueprint $table) {
            $table->unsignedBigInteger('personnel_id')->after('reason');
            $table->unsignedBigInteger('booking_id')->after('personnel_id');
            $table->unsignedBigInteger('user_id')->after('booking_id');

            // Adding foreign key constraints
            $table->foreign('personnel_id')->references('id')->on('personnels')->onDelete('cascade');
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cancel_p_s', function (Blueprint $table) {
            $table->dropForeign(['personnel_id']);
            $table->dropForeign(['booking_id']);
            $table->dropForeign(['user_id']);

            // Dropping the foreign key columns
            $table->dropColumn(['personnel_id', 'booking_id', 'user_id']);
        });
    }
};
