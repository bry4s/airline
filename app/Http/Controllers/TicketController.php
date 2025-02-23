<?php

namespace App\Http\Controllers;

use App\Models\ArchivedTicket;
use App\Models\Plane;
use App\Models\Ticket;
use App\Models\Trip;

class TicketController extends Controller
{
    public function index()
    {
        $user = auth('api')->user();
        if ($user === null) return;
        $tickets = Ticket::where('user_id', $user->id)->get();
        return response()->json(['tickets' => $tickets]);
    }

    public function show()
    {
        $user = auth('api')->user();
        if ($user === null) return;
        $ticket = Ticket::find(request()->header('id'));
        if ($user->id !== $ticket->user_id) return;
        return response()->json(['ticket' => $ticket]);
    }
    
    public function store()
    {
        $entries = request()->validate(['entries' => 'array'])['entries'];
        $trip_id = request()->validate(['trip_id' => 'required|integer'])['trip_id'];
        $trip = Trip::find($trip_id)->first();
        if ($trip === null) return;
        $plane = Plane::find($trip->plane_id);
        $count = 0;
        $total = 0;
        $data = [];
        foreach ($entries as $entry) {
            $data[$count++] = $entry;
            $total += $trip->price * $entry['class'];
        }
        $user = auth('api')->user();
        if ($user === null) return;
        if ($user->balance < $total) {
            return response()->json(['message' => 'insufficient balance'], 402);
        }
        $available = $plane->seats - $trip->count;
        if ($available < $count) { 
            return response()->json(['message' => 
                "plane's capacity reached, you can only buy $available tickets"
            ], 402);
        }
        $trip->increment('count', $count);
        $user->decrement('balance', $total);
        foreach ($data as $d) {
            Ticket::create(array_merge($d, [
                'user_id' => $user->id,
                'trip_id' => $trip_id,
            ]));
            ArchivedTicket::create(array_merge($d, [
                'user_id' => $user->id,
                'trip_id' => $trip_id,
            ]));
        }
        return response()->json(['message' => 'tickets purchased']);
    }

}
