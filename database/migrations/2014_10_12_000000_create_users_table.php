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
            $table->string('name',150);
            $table->string('email',100)->unique();
            $table->string('username',100)->unique()->nullable();
            $table->string('password',200);
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('role')->default(2);
            $table->tinyInteger('status')->default('1')->comment('1:active, 0:inactive, 2:block');
            $table->rememberToken();
            $table->text('device_token')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
