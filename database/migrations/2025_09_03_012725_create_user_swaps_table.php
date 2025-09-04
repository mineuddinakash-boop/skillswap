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
        Schema::create('user_swaps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // user who added/requested
            $table->unsignedBigInteger('swap_request_id'); // swap request
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('swap_request_id')->references('id')->on('swap_requests')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_swaps');
    }
};
