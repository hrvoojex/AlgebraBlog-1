<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin = new Role();
        $roleAdmin->name = 'admin';
        $roleAdmin->description = 'This is an Admin user';
        $roleAdmin->save();

        $roleUser = new Role();
        $roleUser->name = 'user';
        $roleUser->description = 'This is a standard User';
        $roleUser->save();

        $roleOperator = new Role();
        $roleOperator->name = 'operator';
        $roleOperator->description = 'This is an Operator user';
        $roleOperator->save();
    }
}
