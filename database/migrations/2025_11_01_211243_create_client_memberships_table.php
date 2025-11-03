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
        Schema::create('client_memberships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('peoples');
            $table->foreignId('membership_id')->constrained('memberships');
            $table->foreignId('payment_status_id')->constrained('payment_statuses');
            $table->foreignId('membership_status_id')->constrained('membership_statuses');
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('total_price', 8, 2);
            $table->decimal('pending_balance', 8, 2)->nullable();
            $table->decimal('advance_payment', 8, 2)->nullable();
            $table->string('group_code',8)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_memberships');
    }
};
