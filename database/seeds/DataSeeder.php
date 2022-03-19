<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (env('APP_ENV') === 'local') {
            DB::table('users')->insert([
                'name' => env('TEST_USER_NAME'),
                'email' => env('TEST_USER_EMAIL'),
                'password' => Hash::make(env('TEST_USER_PASSWORD')),
            ]);
            DB::table('projects')->insert([
                'name' => "Test Project",
                'details' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce vitae nulla vulputate, maximus lectus sit amet, hendrerit arcu. Cras elit urna, ullamcorper ut pellentesque nec, placerat sed sem. Curabitur ut nulla turpis."
            ]);
        }
    }
}
