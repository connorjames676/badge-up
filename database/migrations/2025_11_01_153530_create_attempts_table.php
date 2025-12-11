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
        Schema::create('attempts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            // To allow an attempt's image to be accessed from local storage
            $table->string('image')->nullable();
            // Checks if coach has approved of the challenge attempt
            $table->boolean('approved')->default(false); 
            $table->bigInteger('user_id')->unsigned();
            // NEED TO UNCOMMENT THIS! ATTEMPTS ARE JUST POSTS RIGHT NOW!!!
            $table->bigInteger('challenge_id')->unsigned();
            $table->bigInteger('num_likes')->default(0);
            $table->bigInteger('num_comments')->default(0);

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('challenge_id')->references('id')->on('challenges')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attempts');
    }
};
