<?php

use Illuminate\Database\Seeder;

class VoteAnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('votables')->where('votable_type', 'App\Answer')->delete();
        $users = \App\User::all();
        $users_count = count($users);
        $votes = [-1, 1];
        foreach (\App\Answer::all() as $answer) {
            for ($i = 0; $i < rand(1, $users_count); $i++) {
                $user = $users[$i];
                $user->voteAnswer($answer, $votes[rand(0, 1)]);
            }
        }
    }
}
