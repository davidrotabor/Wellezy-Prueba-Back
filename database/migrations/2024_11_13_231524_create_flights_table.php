<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->string('departureCity');
            $table->string('arrivalCity');
            $table->string('dateDeparture');
            $table->string('dateArrival');

            $table->foreignId('itinerary_id')->constrained()->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
