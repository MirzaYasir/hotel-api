<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Hotel;

class HotelApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test hotel creation.
     *
     * @return void
     */
    public function test_create_hotel()
    {
        $response = $this->postJson('/api/hotels', [
            'name' => 'Test Hotel',
            'country' => 'US',
            'city' => 'New York',
            'price' => 150.00,
        ]);

        $response
            ->assertStatus(201)
            ->assertJson([
                'name' => 'Test Hotel',
                'country' => 'US',
                'city' => 'New York',
                'price' => 150.00,
            ]);
    }

    /**
     * Test hotel retrieval.
     *
     * @return void
     */
    public function test_get_hotel()
    {
        $hotel = Hotel::factory()->create([
            'name' => 'Test Hotel',
            'country' => 'US',
            'city' => 'New York',
            'price' => 150.00,
        ]);

        $response = $this->getJson('/api/hotels/' . $hotel->id);

        $response
            ->assertStatus(200)
            ->assertJson([
                'name' => 'Test Hotel',
                'country' => 'US',
                'city' => 'New York',
                'price' => 150.00,
            ]);
    }

    /**
     * Test hotel search.
     *
     * @return void
     */
    public function test_search_hotel()
    {
        $hotel = Hotel::factory()->create([
            'name' => 'Search Hotel',
            'country' => 'FR',
            'city' => 'Paris',
            'price' => 200.00,
        ]);

        $response = $this->getJson('/api/hotels?search=Search');

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'name' => 'Search Hotel',
                'country' => 'FR',
                'city' => 'Paris',
                'price' => 200.00,
            ]);
    }
}
