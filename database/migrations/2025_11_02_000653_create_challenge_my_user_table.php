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
        Schema::create('challenge_my_user', function (Blueprint $table) {
            $table->primary(['challenge_id','participant_id']);
            $table->bigInteger('challenge_id')->unsigned();
            $table->bigInteger('participant_id')->unsigned();
            $table->timestamps();

            $table->foreign('challenge_id')->references('id')->on('challenges')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('participant_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('challenge_my_user');
    }
};
