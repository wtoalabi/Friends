<?php

use App\Models\Users\User;
use Illuminate\Database\Seeder;

class FollowingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::inRandomOrder()->get();
            foreach($users as $newUser){
                $newUser->following()->save($newUser);
            }
    }
}
