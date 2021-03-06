<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherSocialLoginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TeacherSocialLogins', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('teacher_id')->unsigned()->index();
          $table->foreign('teacher_id')->references('id')->on('teachers');
          $table->string('provider', 50);
          $table->text('social_id');
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
        Schema::dropIfExists('TeacherSocialLogins');
    }
}
