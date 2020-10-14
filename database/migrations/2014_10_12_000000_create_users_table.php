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
            $table->id();
            $table->unsignedBigInteger('INN');
            $table->string('f_name');
            $table->string('l_name');
            $table->string('m_name');
            $table->timestamp('employ_date')->nullable();
            $table->timestamp('employ_document_date')->nullable();
            $table->unsignedBigInteger('employ_document_number')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('salary');
            $table->string('adress')->nullable();
            $table->string('phone')->unique();
//            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
//            $table->foreignId('current_team_id')->nullable();
//            $table->text('profile_photo_path')->nullable();
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
        Schema::dropIfExists('users');
    }
}
