<?php

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
        factory(App\User::class, 10)->create()->each(function ($user) {
            $user->questions()
                ->saveMany(
                  factory(App\Question::class, rand(2, 5))->make()
                )->each(function ($question) {
                    $question->answers()->saveMany(factory(\App\Answer::class, rand(2, 5))->make());
                });
        });
    }
}
