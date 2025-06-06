<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


class TaskPriorities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('task_priorities', function (Blueprint $table) {
        $table->id();
        $table->string('level'); // e.g., low, medium, high
        $table->timestamps();
    });

    // Seed default priorities
    DB::table('task_priorities')->insert([
        ['level' => 'Low'],
        ['level' => 'Medium'],
        ['level' => 'High'],
    ]);
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
