<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\UserDetailModel;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CommutingMethods::class,
            EnergySources::class,
            DietaryPreferences::class
        ]);

        Role::create(['name' => 'admin', 'guard_name' => 'web']);
        Role::create(['name' => 'user', 'guard_name' => 'web']);

        $faker = \Faker\Factory::create('id_ID');
        $admin = User::create([
            'name' => 'Administator',
            'username' => 'sudo',
            'email' => "superadmin@hcs.com",
            'phone' => '081234567890',
            'password' => bcrypt('1234')
        ]);
        $admin->assignRole('admin');

        for ($i = 0; $i < 3; $i++) {
            $user = User::create([
                'name' => $faker->name,
                'username' => $faker->userName,
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
                'password' => bcrypt('1234')
            ]);
            UserDetailModel::create([
                'user_id' => $user->id,
                'commuting_method_id' => $faker->numberBetween(1, 7),
                'dietary_preference_id' => $faker->numberBetween(1, 5),
                'energy_source_id' => $faker->numberBetween(1, 6)
            ]);
            $user->assignRole('user');
        }
    }
}
