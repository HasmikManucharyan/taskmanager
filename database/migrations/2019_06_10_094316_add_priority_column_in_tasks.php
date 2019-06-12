<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPriorityColumnInTasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {            
            if(!Schema::hasColumn('tasks','priority')) {
                $table->string('priority',20);
            }
            if(!Schema::hasColumn('tasks','description')) {
                $table->text('description')->default(null);
            }
            if(!Schema::hasColumn('tasks','img')) {
                $table->text('img')->default(null);
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            //
        });
    }
}
