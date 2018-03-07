<?php

use App\Models\Users\User;
use App\Models\Images\Album;
use App\Models\Statuses\Mood;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'email'=> 'test@test.com',
            'username'=> 'admin',
            'password' => test,
            'auth' => 1,
        ]);
        factory(Mood::class)->create([
            'name' => 'Happy',
            'icon' => 'heart',
            'color' => 'is-primary',
        ]);
        factory(Mood::class)->create([
            'name' => 'Excited',
            'icon' => 'smile',
            'color' => 'is-warning',
        ]);
    }
}
