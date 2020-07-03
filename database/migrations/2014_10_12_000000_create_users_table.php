<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('clear_data_1')->default(0);
            $table->integer('clear_data_2')->default(0);
            $table->integer('clear_data_3')->default(0);
            $table->integer('clear_data_4')->default(0);
            $table->integer('clear_data_5')->default(0);
            $table->integer('clear_data_6')->default(0);
            $table->integer('clear_data_7')->default(0);
            $table->integer('clear_data_8')->default(0);
            $table->rememberToken();
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
