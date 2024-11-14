<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;
    protected $fillable = ['departureCity', 'arrivalCity', 'dateDeparture', 'dateArrival', 'itinerary_id'];

    public function itinerary() {
        return $this->belongsTo(Itinerary::class);
    }
    
}
