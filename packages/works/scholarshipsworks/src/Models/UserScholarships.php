<?php

namespace Works\Scholarshipsworks\Models;

use Illuminate\Database\Eloquent\Model;

class UserScholarships extends Model
{
    protected $table = 'user_scholarships';

    protected $fillable = [
        'name',
        'surname',
        'username',
        'email',
        'phone',
        'social_networks',
        'motivations',
        'what_it_offers',
        'what_it_asks_for',
    ];

    protected $casts = [
        'social_networks' => 'array', // Cast 'social_networks' to array as it will be stored as JSON
    ];

    public function scholarshipsAsCandidate()
    {
        return $this->hasMany(Scholarships::class, 'candidate');
    }

    public function scholarshipsAsBenefactor()
    {
        return $this->hasMany(Scholarships::class, 'benefactor');
    }

}
