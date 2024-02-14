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
        Schema::create('friendship', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_sender');
            $table->unsignedBigInteger('user_receiver');
            $table->foreignId('user_sender')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('user_receiver')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('friendship');
    }
};
