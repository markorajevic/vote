<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    public $timestamps = false;

    public function votedCountry() {
        return $this->belongsTo(Country::class, 'voted_country');
    }
    public function votingCountry() {
        return $this->belongsTo(Country::class, 'voting_country');
    }
}
