<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\File;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'Julião Kataleko',
            'email' => 'juliofeli78@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt(123456), // password
            'remember_token' => Str::random(10),
        ]);

        for ($i=0; $i < 10; $i++) {
            File::create([
                'title' => "Ficheiro " . $i,
                "url" => "ficheiro$i.jpg",
                "user_id" => rand(1,2),
                'uuid' => Uuid::uuid4()
            ]);
        }
    }
}
