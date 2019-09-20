<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserGradeClasses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_grade_classes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger("grade_class_id");
            $table->unsignedInteger("user_id");
            $table->timestamps();

            $table->foreign("grade_class_id")->references("id")->on("grade_classes")->onDelete('cascade');
            $table->foreign("user_id")->references("id")->on("users")->onDelete('cascade');
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
