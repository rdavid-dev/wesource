<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        //Truncate the 
        DB::table('users')->truncate();

        //Create user
        User::factory()->count(20)->create();

        $faker = \Faker\Factory::create();

        //Read all user to create profile data using faker
        foreach(User::all() as $user) {
            $user->profile()->create([
                'address' => $faker->streetAddress(),
                'phone_number' => $faker->phoneNumber(),
                'fb_username' => $faker->userName()
            ]);
        }
        Schema::enableForeignKeyConstraints();
    }
}
