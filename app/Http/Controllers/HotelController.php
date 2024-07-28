<?php

namespace App\Http\Controllers;

use App\Http\Requests\HotelRequest;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource, with optional sorting and searching.
     */
    public function index(Request $request)
    {
        $query = Hotel::query();

        // Search functionality
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%$search%")
                ->orWhere('country', 'like', "%$search%")
                ->orWhere('city', 'like', "%$search%");
        }

        // Sorting functionality
        if ($request->has('sort_by')) {
            $sortBy = $request->input('sort_by');
            $sortOrder = $request->input('sort_order', 'asc'); // Default to ascending order

            if (in_array($sortBy, ['name', 'country', 'city', 'price'])) {
                $query->orderBy($sortBy, $sortOrder);
            }
        }

        $hotels = $query->get();

        return response()->json($hotels);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HotelRequest $request)
    {
        // Create the hotel
        $hotel = Hotel::create($request->only(['name', 'country', 'city', 'price']));

        // Create the room facilities
        if ($request->has('room_facilities')) {
            foreach ($request->input('room_facilities') as $facility) {
                $hotel->roomFacilities()->create($facility);
            }
        }

        return response()->json($hotel->load('roomFacilities'), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $hotel = Hotel::find($id);

        if (!$hotel) {
            return response()->json(['error' => 'Hotel not found'], 404);
        }

        return response()->json($hotel);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HotelRequest $request, string $id)
    {
        $hotel = Hotel::find($id);

        if (!$hotel) {
            return response()->json(['error' => 'Hotel not found'], 404);
        }

        $hotel->update($request->only(['name', 'country', 'city', 'price']));

        return response()->json($hotel);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hotel = Hotel::find($id);

        if (!$hotel) {
            return response()->json(['error' => 'Hotel not found'], 404);
        }

        $hotel->delete();

        return response()->json(['message' => 'Hotel deleted successfully']);
    }
}