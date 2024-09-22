<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;

use Illuminate\Routing\Controller;


class EventController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }
    public function index()
    {
        //
        return EventResource::collection(Event::with('user')->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        // Add the user_id to the validated data
        $validatedData['user_id'] = $request->user()->id;

        // Create the event with the validated data
        $event = Event::create($validatedData);

        return $event;
    }


    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
        $event->load('user', 'attendees');
        return new EventResource($event);
    }

    /**0
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'sometimes|date',
            'end_time' => 'sometimes|date|after:start_time'
        ]);


        $event->update($validatedData);

        return $event;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
        $event->delete();
        return response(status: 204);
    }
}
