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
        Schema::create('horoscopes', function (Blueprint $table) {
            $table->id();
            $table->string('zodiac_sign');
            $table->date('date');
            $table->string('type'); // daily, weekly
            $table->text('description');
            $table->integer('love_rating')->default(3);
            $table->integer('career_rating')->default(3);
            $table->integer('wellness_rating')->default(3);
            $table->integer('lucky_number')->nullable();
            $table->string('lucky_color')->nullable();
            $table->timestamps();

            // Add index for quick lookups
            $table->index(['zodiac_sign', 'date', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horoscopes');
    }
};
