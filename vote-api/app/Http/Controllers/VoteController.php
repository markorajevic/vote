<?php

namespace App\Http\Controllers;

use App;
use App\Vote;
use App\Country;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;

use DB;

class VoteController extends Controller
{
    public function vote(Request $request)
    {
        $votes = $request->all();
                // check if there isa valid number of votes


        // check if there isa valid number of votes
        $valid = !count($votes) != count(array_unique($votes, SORT_REGULAR));

        $countries = array();

        foreach ($votes as $vote) {
            array_push($countries, $vote['voted_country']);
        }

        $countries = array_unique($countries, SORT_REGULAR);

        if(count($countries) != 10) {
            $valid = false;
        }

        // Check if user is voting for itself
         foreach ($votes as $vote){
            $votingCountry = $vote['voting_country'];
             if($vote['voting_country'] == $vote['voted_country']) {
                return Response::json([
                    'message' => 'ERROR_VOTE_FOR_YOURSELF'
                ], 400); // Status code here
                $valid = false;
             }
        }


        $databaseVotes = App\Vote::where('voting_country', $votingCountry)->count();

        if($databaseVotes != 0) {
            return Response::json([
                'message' => 'ALREADY_VOTED'
            ], 400); // Status code here
        }

        if($valid) {
            foreach ($votes as $vote){
                $tempVote = new Vote;
                $tempVote->voting_country = $vote['voting_country'];
                $tempVote->voted_country = $vote['voted_country'];
                $tempVote->points = $vote['points'];
                $tempVote->save();
            }

            $country = App\Country::where('id', $votingCountry)->first();
            $country->voted = 1;
            $country->save();
            return $country;
        } else {
            return Response::json([
                'message' => 'SOMETHING_WRONG'
            ], 400); // Status code here
        }
    }


    public function getResults()
    {

        $votes = App\Vote::select(DB::raw('*, SUM(points) as totalPoints'))
            ->groupBy('voted_country')
            ->orderBy('totalPoints','DESC')
            ->get();

        foreach($votes as $vote) {
            $vote->country = $vote->votedCountry;
            $vote->totalPoints = (int)$vote->totalPoints;
            unset($vote->voting_country);
            unset($vote->points);
            unset($vote->votedCountry);
            unset($vote->voted_country);
        }

        return $votes;
    }


}