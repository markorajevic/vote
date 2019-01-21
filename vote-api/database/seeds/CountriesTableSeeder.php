<?php

use Illuminate\Database\Seeder;
use App\Country;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('votes')->delete();
        DB::table('countries')->delete();
        $json = File::get("database/data/countries.json");
        $data = json_decode($json);
        foreach ($data as $obj) {
            Country::create(array(
              'name' => $obj->name,
              'code' => $obj->code,
              'voted' => 0
            ));
          };
    }
}
