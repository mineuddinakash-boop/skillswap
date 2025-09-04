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
        Schema::create('accepted_swaps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user1_id'); // requester
            $table->unsignedBigInteger('user2_id'); // skill owner
            $table->unsignedBigInteger('swap_request_id');
            $table->timestamps();

            $table->foreign('user1_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user2_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('swap_request_id')->references('id')->on('swap_requests')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accepted_swaps');
    }
};
