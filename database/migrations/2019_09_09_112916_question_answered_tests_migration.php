<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class QuestionAnsweredTestsMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_answered_tests', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger("answered_test_id");
            $table->unsignedInteger("question_id");
            $table->integer("option_choosed");
            $table->timestamps();

            $table->foreign("answered_test_id")->references("id")->on("answered_tests")->onDelete('cascade');
            $table->foreign("question_id")->references("id")->on("questions")->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_answered_tests');
    }
}
