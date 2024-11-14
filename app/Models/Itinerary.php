<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{
    use HasFactory;
    protected $fillable = ['departureCity', 'arrivalCity', 'dateDeparture', 'timeDeparture'];
    
    public function flights() {
        return $this->hasMany(Flight::class);
    }
}
