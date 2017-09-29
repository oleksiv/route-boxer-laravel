<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $owner = new \App\Role();
        $owner->name = 'admin';
        $owner->display_name = 'Project Admin';
        $owner->save();

        $owner = new \App\Role();
        $owner->name = 'user';
        $owner->display_name = 'Project User';
        $owner->save();
    }
}
