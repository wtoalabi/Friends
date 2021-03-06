<?php

use App\Models\Users\User;
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
            factory(User::class, 20)->create();
            $users = User::inRandomOrder()->take(20)->get();
            foreach($users as $user){
                $randomPoster = User::inRandomOrder()->first();
                factory(Status::class,2)->create(['user_id'=> $user->id, 
                        'profile_id'=> $randomPoster->id,
                        'slug'=> "$user->username/status/" .str_random(30).time()]);
                $user->following()->attach($randomPoster->id);
            }
    }
}
