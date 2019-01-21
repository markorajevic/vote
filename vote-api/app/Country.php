<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Vote;


class Country extends Model
{
    public $timestamps = false;

    public function votedCountry()
    {
        return $this->hasOne('App\Vote', 'voted_country');

    }

    public function votingCountry()
    {
        return $this->hasOne('App\Vote', 'voting_country');

    }
}
