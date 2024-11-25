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
        Schema::table('users', function (Blueprint $table) {
            // Adding foreign keys
            $table->unsignedBigInteger('barangay_id')->nullable()->after('password');
            $table->unsignedBigInteger('municipality_id')->nullable()->after('barangay_id');
            $table->unsignedBigInteger('province_id')->nullable()->after('municipality_id');
            $table->foreign('barangay_id')->references('id')->on('barangays')->onDelete('set null');
            $table->foreign('municipality_id')->references('id')->on('municipalities')->onDelete('set null');
            $table->foreign('province_id')->references('id')->on('provinces')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['barangay_id']);
            $table->dropForeign(['municipality_id']);
            $table->dropForeign(['province_id']);
        });
    }
};
