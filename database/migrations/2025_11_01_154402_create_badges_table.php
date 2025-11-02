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
        Schema::create('badges', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->bigInteger('participant_id')->unsigned();
            $table->bigInteger('challenge_id')->unsigned();

            $table->foreign('participant_id')->references('id')->on('my_users')
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
        Schema::dropIfExists('badges');
    }
};
