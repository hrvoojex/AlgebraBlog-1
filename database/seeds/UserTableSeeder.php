<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin = Role::where('name', 'admin')->first();
        $roleUser = Role::where('name', 'user')->first();
        $roleOperator = Role::where('name', 'operator')->first();

        $admin = new User();
        $admin->name = 'Admin Admin';
        $admin->email = 'admin@admin.com';
        $admin->password = bcrypt('admin');
        $admin->save();
        $admin->roles()->attach($roleAdmin);

        $user = new User();
        $user->name = 'User User';
        $user->email = 'user@user.com';
        $user->password = bcrypt('user');
        $user->save();
        $user->roles()->attach($roleUser);

        $operator = new User();
        $operator->name = 'Operator O';
        $operator->email = 'operator@operator.com';
        $operator->password = bcrypt('operator');
        $operator->save();
        $operator->roles()->attach($roleOperator);
    }
}
