<?php

namespace Database\Seeders;

use App\Models\Role\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::where('slug', 'admin')->first();

        User::firstOrCreate(
            ['email' => 'admin@flap.com.br'],
            [
                'name' => 'Administrador',
                'password' => bcrypt('Admin@123'),
                'role_id' => $adminRole ? $adminRole->id : null,
            ]
        );
    }
}
