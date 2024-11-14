<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('itineraries', function (Blueprint $table) {
            $table->id();
            $table->string('departureCity');
            $table->string('arrivalCity');
            $table->string('dateDeparture');
            $table->string('timeDeparture');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('itineraries');
    }
};
