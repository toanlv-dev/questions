<?php

use App\Question;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FavoritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('favorites')->delete();
        $users = User::query()->pluck('id')->all();
        $numberOfCount = count($users);

        foreach (Question::all() as $question) {
            for($i = 0; $i < rand(1, $numberOfCount); $i++) {
                $question->favorites()->attach($users[$i]);
            }
        }
    }
}
