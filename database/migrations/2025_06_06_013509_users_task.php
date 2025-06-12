<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsersTask extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('user_task', function (Blueprint $table) {
        $table->id(); // better than manually setting integer 'id'
        $table->string('task_title');
        $table->text('task_desc'); // use text for longer descriptions
        $table->date('start_date');
        $table->date('end_date');
        $table->unsignedBigInteger('employee_id'); // foreign key size match
        $table->unsignedTinyInteger('status')->default(0); // 0 = pending, etc.
        $table->unsignedTinyInteger('priority_task')->default(0); // spelling fix + default
        $table->unsignedBigInteger('assigned_by');
        $table->timestamps(); // adds created_at and updated_a
        // Optionally add foreign key constraint if employee_id comes from users or employees table
        $table->foreign('employee_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('status')->references('id')->on('task_status')->onDelete('restrict');
        $table->foreign('priority_task')->references('id')->on('task_priorities')->onDelete('restrict');
        $table->foreign('assigned_by')->references('id')->on('users')->onDelete('restrict');
    });
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
