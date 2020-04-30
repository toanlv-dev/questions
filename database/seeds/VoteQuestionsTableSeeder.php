<?php

use Illuminate\Database\Seeder;

class VoteQuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('votables')->where('votable_type', 'App\Question')->delete();
        $users = \App\User::all();
        $users_count = count($users);
        $votes = [-1, 1];
        foreach (\App\Question::all() as $question) {
            for ($i = 0; $i < rand(1, $users_count); $i++) {
                $user = $users[$i];
                $user->voteQuestion($question, $votes[rand(0, 1)]);
            }
        }
    }
}
