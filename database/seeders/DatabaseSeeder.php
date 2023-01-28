<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
         \App\Models\User::factory(10)->create();
         \App\Models\Conversation::factory(3)->create();



        $user1 = \App\Models\User::find(1);
        $user1->conversations()->attach(1);
        $user1->conversations()->attach(2);
        $user1->conversations()->attach(3);

        $user2 = \App\Models\User::find(2);
        $user2->conversations()->attach(1);
        $user2->conversations()->attach(2);

        $user3 = \App\Models\User::find(3);
        $user3->conversations()->attach(3);


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
