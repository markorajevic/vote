<?php

namespace App\Http\Controllers;

use App;
use App\Country;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;

class CountryController extends Controller
{

    public function listAllCountries()
    {
        $countries = App\Country::all();
        return $countries;
    }

    public function getCountry($code)
    {
        return App\Country::where('code', $code)->first();
    }

}