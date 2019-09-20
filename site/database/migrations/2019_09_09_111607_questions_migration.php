<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class QuestionsMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger("test_id");
            $table->unsignedInteger("topic_id");
            $table->string("nick")->default("Questao sem titulo");
            $table->integer("number");
            $table->integer("correct_answer");
            $table->integer("option_quant");
            $table->enum("dificult", ["f", "m", "d"])->default(null);
            $table->timestamps();

            $table->foreign("test_id")->references("id")->on("tests")->onDelete('cascade');
            $table->foreign("topic_id")->references("id")->on("topics")->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
