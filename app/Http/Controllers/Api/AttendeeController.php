<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AttendeeResource;
use App\Models\Attendee;
use App\Models\Event;
use Illuminate\Http\Request;

class AttendeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Event $event)
    {
        // Retrieve the latest attendees for the event and paginate them
        $attendees = $event->attendees()->with('user')->latest()->paginate(10);

        // Return the paginated list using the AttendeeResource collection
        return AttendeeResource::collection($attendees);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Event $event)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'user_id' => 'sometimes|exists:users,id'
        ]);

        // Create the attendee with the validated data
        $attendee = $event->attendees()->create($validatedData);

        return new AttendeeResource($attendee);
    }


    /**
     * Display the specified resource.
     */
    public function show(Event $event, Attendee $attendee)
    {
        // Load the user relationship
        $attendee->load('user');

        // Return the AttendeeResource
        return new AttendeeResource($attendee);
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $event, Attendee $attendee)
    {
        //
        $attendee->delete();
        return response()->json(null, 204);
    }
}
