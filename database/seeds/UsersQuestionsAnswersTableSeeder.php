<?php

use Illuminate\Database\Seeder;

class UsersQuestionsAnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('answers')->delete();
        \Illuminate\Support\Facades\DB::table('questions')->delete();
        \Illuminate\Support\Facades\DB::table('users')->delete();
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
