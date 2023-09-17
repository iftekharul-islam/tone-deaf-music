<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Constants\RolesConstant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => 12345678,
            ],
            [
                'name' => 'Manager',
                'email' => 'manager@example.com',
                'password' => 12345678,
            ],
            [
                'name' => 'Staff',
                'email' => 'staff@example.com',
                'password' => 12345678,
            ],
        ];

        foreach ($users as $item) {
            $user = User::create($item);
            if ($item['name'] == 'Admin') {
                $user->assignRole(RolesConstant::ADMIN);
            } elseif ($item['name'] == 'Manager') {
                $user->assignRole(RolesConstant::VENUE_MANAGERS);
            } else {
                $user->assignRole(RolesConstant::VENUE_STAFF);
            }
        }

        User::factory(22)
            ->create()
            ->each(function ($user) {
                $user->assignRole(RolesConstant::USER);
            });

        User::orderBy('id', 'desc')
            ->take(10)
            ->get()
            ->each(function ($user) {
                $user->syncRoles([RolesConstant::VENUE_STAFF]);
                $user->update([
                    'manager_id' => User::where('email', 'manager@example.com')->first()->id
                ]);
            });
    }
}
