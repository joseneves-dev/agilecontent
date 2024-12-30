<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

use Carbon\Carbon;

use App\Models\User;
use App\Models\Country;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $currentTimestamp = Carbon::now();

        $countries = [
            ['name' => 'Spain', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['name' => 'Portugal', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['name' => 'France', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['name' => 'Germany', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['name' => 'Italy', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['name' => 'United Kingdom', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['name' => 'Netherlands', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['name' => 'Belgium', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['name' => 'Sweden', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['name' => 'Norway', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
        ];

        Country::insert($countries);

        User::create([
            'name' => 'Test User',
            'countryId' => 1,
            'isActive' => 1,
            'password' => Hash::make('123456789'),
            'email' => 'test@example.com',
        ]);
    }
}
