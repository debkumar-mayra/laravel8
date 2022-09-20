<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserRoleTableSeeder::class,
            AdminSeeder::class,
        ]);
        // \App\Models\User::factory(50)->create();
    }
}
