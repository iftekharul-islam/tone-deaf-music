<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Venue;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VenueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user_manager = User::where('email', 'manager@example.com')->first();
        $user_staff = User::where('email', 'staff@example.com')->first();

        $user_staff->update([
            'manager_id' => $user_manager->id
        ]);

        Venue::factory(10)
            ->create()
            ->each(function ($venue) use ($user_manager, $user_staff) {
                $venue->owner()->associate($user_manager->id)->save();
                $venue->update([
                    'staff_id' => $user_staff->id,
                ]);
            });
    }
}
