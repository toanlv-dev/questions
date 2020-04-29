<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('votable_id')->comment('This Id of question or answer');
            $table->string('votable_type')->comment('Model class of question of answer');
            $table->tinyInteger('vote')->comment('-1 vote down; +1 vote up');
            $table->timestamps();
            $table->unique(['user_id', 'votable_id', 'votable_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('votables');
    }
}
