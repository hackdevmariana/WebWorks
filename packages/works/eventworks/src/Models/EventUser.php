<?php

namespace Works\Eventworks\Models;

use Illuminate\Database\Eloquent\Model;

class EventUser extends Model
{
    protected $fillable = ['name', 'email', 'role'];

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'transmitter');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver');
    }
}
