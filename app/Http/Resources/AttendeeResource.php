<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AttendeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id, // Attendee ID
            'user_id' => $this->user_id, // User ID
            'name' => $this->user ? $this->user->name : null,  // Fetch name from the User model, or null if user doesn't exist
            'email' => $this->user ? $this->user->email : null, // Fetch email from the User model, or null if user doesn't exist
            'description' => $this->event->description, // Fetch description from the related Event model
        ];
    }
}
