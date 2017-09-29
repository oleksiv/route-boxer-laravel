<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User();
        $user->name = 'Sviatoslav Oleksiv';
        $user->email = 'hi.oleksiv@gmail.com';
        $user->password = bcrypt('secret');
        $user->save();


        $role = \App\Role::where(['name' => 'admin'])->first();
        $user->attachRole($role);
    }
}
