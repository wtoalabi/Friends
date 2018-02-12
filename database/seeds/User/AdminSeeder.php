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
            'email'=> 'wtoalabi@gmail.com',
            'username'=> 'admin',
            'password' => 12,
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
