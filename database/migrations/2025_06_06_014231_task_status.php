<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


class TaskStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('task_status', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // e.g., pending, in progress, completed
        $table->timestamps();
    });

    // Seed default statuses
    DB::table('task_status')->insert([
        ['name' => 'Pending'],
        ['name' => 'In Progress'],
        ['name' => 'Completed'],
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
