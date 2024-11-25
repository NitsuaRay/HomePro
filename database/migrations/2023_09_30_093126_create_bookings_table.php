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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('personnel_id')->nullable()->constrained('personnels');
            $table->text('work_details')->nullable();
            $table->text('picture_details')->nullable();
            $table->dateTime('service_date')->nullable();
            $table->enum('payment_method', ['Upon Arrival', 'GCash'])->default('Upon Arrival');
            $table->text('gcash_picture')->nullable();
            $table->decimal('fee', 10, 2)->nullable();
            $table->decimal('extra_fee', 10, 2)->nullable();
            $table->enum('booking_status', ['Pending', 'Cancelled', 'Accepted', 'Completed'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
