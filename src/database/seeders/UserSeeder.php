<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = $this->makeRoles();
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123')
        ]);
        
        $user = User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('user123')
        ]);

        $admin->assignRole($role->admin);
        $user->assignRole($role->user);
    }

    private function makeRoles(): object
    {
        return (object) [
            'admin' => Role::create(['name' => 'admin']),
            'user' => Role::create(['name' => 'user']),
        ];
    }
}
