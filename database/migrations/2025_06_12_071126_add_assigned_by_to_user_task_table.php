<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAssignedByToUserTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('user_task', function (Blueprint $table) {
        $table->unsignedBigInteger('assigned_by')->after('priority_task');
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
        Schema::table('user_task', function (Blueprint $table) {
        $table->dropForeign(['assigned_by']);
        $table->dropColumn('assigned_by');
    });
    }
}
