<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = json_decode(File::get(__DIR__ . "/json/countries.json"));

        foreach ($countries as $country) {
            $_country = Country::create([
                "name" => $country->name,
            ]);

            foreach ($country->list as $code) {
                $_country->postalCodes()->create([
                    "postal_code" => $code->postal_code,
                    "city" => $code->city,
                    "state" => $code->state,
                ]);
            }
        }
    }
}
