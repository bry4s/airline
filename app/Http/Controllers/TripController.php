<?php

namespace App\Http\Controllers;

use App\Models\ArchivedTrip;
use App\Models\Trip;

class TripController extends Controller
{
    public function index()
    {
        $trips = Trip::join('planes', 'planes.id', 'trips.id')
            ->where('trips.departure', '>', now()->addMinutess(17))
            ->where('planes.seats', '>', 'trips.count')
            ->get();
        return response()->json(['trips' => $trips]);
    }

    public function show()
    {
        $trip = Trip::find(request()->header('id'));
        return response()->json(['trip' => $trip]);
    }
    
    public function store()
    {
        $data = request()->validate([
            'plane_id' => 'required|integer',
            'price' => 'required|numeric',
            'from' => 'required|max:255',
            'to' => 'required|max:255',
            'departure' => 'required|date',
            'arrival' => 'required|date',
        ]);
        $data['count'] = 0;
        return response()->json(['g' => $data]);
        Trip::create($data);
        ArchivedTrip::create($data);
        return response()->json(['message' => 'trip added']);
    }
}
