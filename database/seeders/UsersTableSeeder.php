<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Get the location of the given user
        $latitude = -33.97125160;
        $longitude = 151.11387840;

        for ($i = 0; $i < 5; $i++) {
            // Generate random coordinates within 100km of the given user
            $coords = $this->getRandomCoordinates($latitude, $longitude, 100);

            DB::table('users')->insert([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'password' => Hash::make('user12345'),
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'date_of_birth' => $faker->dateTimeBetween('-80 years', '-18 years')->format('Y-m-d'),
                'gender' => $faker->randomElement(['male', 'female', 'other']),
                'address' => $faker->address,
                'latitude' => $coords['latitude'],
                'longitude' => $coords['longitude'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
     /**
     * Get random coordinates within a specified radius (in km) of a given point
     *
     * @param float $latitude
     * @param float $longitude
     * @param float $radius
     * @return array
     */
    private function getRandomCoordinates($latitude, $longitude, $radius) {
        $radiusInDegrees = $radius / 111.045; // Approximate degrees per km at equator
        $u = rand() / getrandmax();
        $v = rand() / getrandmax();
        $w = $radiusInDegrees * sqrt($u);
        $t = 2 * pi() * $v;
        $x = $w * cos($t);
        $y = $w * sin($t);
        $xp = $x / cos(deg2rad($latitude));
        $newLat = $latitude + $y;
        $newLong = $longitude + $xp;
        return array('latitude' => $newLat, 'longitude' => $newLong);
    }

}
