<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AnsweredTestsMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answered_tests', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger("test_id");
            $table->unsignedInteger("school_member_enroll");
            $table->integer("score")->default(0);
            $table->boolean("done")->default(false);
            $table->timestamps();
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('answered_tests', function (Blueprint $table) {
            //
        });
    }
}
