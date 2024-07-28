<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hotel extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'country',
        'city',
        'price',
    ];

    /**
     * Get the room facilities for the hotel.
     */
    public function roomFacilities(): HasMany
    {
        return $this->hasMany(RoomFacility::class);
    }
}
