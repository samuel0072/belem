<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SchoolMembersMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_members', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger("enroll");
            $table->unsignedInteger("grade_class_id");
            $table->string("name");
            $table->integer("age");
            $table->enum("type", ["aluno", "professor"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('school_members');
    }
}
