<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create()->each(function ($user){
            Post::factory(10)->create([
                'user_id'=>$user->id,
            ]);
        });
        
        User::factory()->create([
            'name' => 'mahdi rahmani',
            'email' => 'rahmanimahdi16@gmail.com',
            'password'=>'Ma13R18@'
        ]);
    }
}
