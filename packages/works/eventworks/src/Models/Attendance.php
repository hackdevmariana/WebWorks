<?php

namespace Works\Eventworks\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = ['event_id', 'participant_id', 'status', 'registration_date'];

    // Relación con Event
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // Relación con Participant
    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }
}
