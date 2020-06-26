<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name' => 'admin',
            'email' => '2000.khz@gmail.com',
            'password' => bcrypt('admin'),
        ]);

        factory(App\User::class, 10)->create(); /*->each(function ($u) {
            $u->posts()->save(factory(App\Post::class)->make());
        });
        */
    }
}
