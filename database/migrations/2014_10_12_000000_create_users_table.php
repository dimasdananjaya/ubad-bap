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
            $table->bigIncrements('id_user');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('periode', function (Blueprint $table) {
            $table->bigIncrements('id_periode');
            $table->string('periode');
            $table->string('status');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('bap', function (Blueprint $table) {
            $table->bigIncrements('id_bap');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_periode');
            $table->string('mata_kuliah');
            $table->number('sks');
            $table->date('tanggal');
            $table->time('jam');
            $table->string('materi');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('users');
            $table->foreign('id_periode')->references('id_periode')->on('periode');
        });

        Schema::create('file_bap', function (Blueprint $table) {
            $table->bigIncrements('id_file_bap');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_periode');
            $table->string('file_bap');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('users');
            $table->foreign('id_periode')->references('id_periode')->on('periode');
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
