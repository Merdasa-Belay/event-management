<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;


class EventController extends Controller
{

    public function index()
    {
        //
        return Event::all();
    }

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
        $validatedData['user_id'] = 1;

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
        return $event;
    }

    /**0
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
