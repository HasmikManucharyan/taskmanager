<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'email_verified_at') || Schema::hasColumn('users', 'created_at') || Schema::hasColumn('users', 'updated_at')) {
                $table->dropColumn(['email_verified_at','created_at','updated_at']);
            }
            if(!Schema::hasColumn('users','type')) {
                $table->string('type',20)->default('developer');
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
        Schema::dropIfExists('users');
    }
}
