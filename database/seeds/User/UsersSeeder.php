<?php

use App\Models\Users\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Models\Statuses\Status;
use App\Models\Images\ProfileImage;

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
                factory(Status::class,2)->create(['user_id'=> $user->id, 'profile_id'=> $randomPoster->id]);
                factory(ProfileImage::class)->create(['user_id'=>$user->id]);
                $user->following()->attach($randomPoster->id);
            }
    }
}
