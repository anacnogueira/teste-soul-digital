<?php

use Illuminate\Database\Seeder;
use \App\Entities\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Entities\User', 1)->create();
    }
}
