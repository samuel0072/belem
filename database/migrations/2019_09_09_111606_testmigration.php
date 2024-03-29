<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Testmigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger("grade_class_id");
            $table->unsignedInteger("subject_id");
            $table->string("nick")->default("Prova sem titulo");
            $table->timestamps();

            $table->foreign("grade_class_id")->references("id")->on("grade_classes")->onDelete('cascade');
            $table->foreign("subject_id")->references("id")->on("subjects")->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tests');
    }
}
