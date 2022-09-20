<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->insertGetId([
        //     'first_name' => 'admin',
        //     'email' => 'admin@admin.com',
        //     'password' => Hash::make('123456'),
        //     'role' => 1,
        //     'created_at' => date('Y-m-d H:i:s'),
        //     'updated_at' => date('Y-m-d H:i:s'),
        // ]);

        $superAdminUser = User::create([
            'first_name' => "Admin",
            'last_name' => "Admin",
            'email' => "admin@admin.com",
            'password' => "123456",
        ]);
        $superAdminUser->assignRole('SUPER-ADMIN');
        User::factory(50)->create()->each(function ($user) {
            $user->assignRole('USER');
        });
    }
}
