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
        Schema::table('personnels', function (Blueprint $table) {
            $table->enum('isVerified', ['Verified', 'Not Verified'])->default('Not Verified');
            $table->string('id_picture')->nullable(); // Nullable if the ID picture is not required initially
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('personnels', function (Blueprint $table) {
            $table->dropColumn('isVerified');
            $table->dropColumn('id_picture');
        });
    }
};
