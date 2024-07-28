<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hotel;
use App\Models\RoomFacility;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a hotel
        $hotel = Hotel::create([
            'name' => 'Hotel Example',
            'country' => 'US',
            'city' => 'New York',
            'price' => 150,
        ]);

        // Add room facilities to the hotel
        $facilities = [
            ['facility' => 'Free Wi-Fi'],
            ['facility' => 'Swimming Pool'],
            ['facility' => 'Gym'],
            ['facility' => 'Spa'],
        ];

        // Create room facilities for the hotel
        foreach ($facilities as $facility) {
            $hotel->roomFacilities()->create($facility);
        }
    }
}
