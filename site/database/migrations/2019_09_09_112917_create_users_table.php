<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedInteger('access_level')->default(0);
            $table->unsignedInteger('school_id')->default(0);
            $table->unsignedInteger('grade_class_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->foreign("school_id")->references("id")->on("schools")->onDelete('cascade');
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
        Schema::dropIfExists('users');
    }
}
