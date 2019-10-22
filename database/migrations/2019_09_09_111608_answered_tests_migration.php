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
            $table->unsignedInteger("school_member_id");
            $table->unsignedInteger("grade_class_id");
            $table->integer("score")->default(0);
            $table->boolean("done")->default(false);
            $table->timestamps();
            //
            $table->foreign("test_id")->references("id")->on("tests")->onDelete('cascade');
            $table->foreign("school_member_id")->references("id")->on("school_members")->onDelete('cascade');
            $table->foreign("grade_class_id")->references("id")->on("grade_classes")->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answered_tests');
    }
}
