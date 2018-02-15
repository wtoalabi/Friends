<?php

use App\Models\Users\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Models\Statuses\Status;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 20)->create()->each(function($user){
            $user = User::inRandomOrder()->first();
            factory(Status::class, 5)->create(['user_id'=> $user->id, 'profile_id'=> $user->id]);
            $user->following()->save($user);
        });
    }
}
