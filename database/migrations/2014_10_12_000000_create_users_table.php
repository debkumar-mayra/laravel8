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
            $table->string('first_name', 150)->nullable();
            $table->string('last_name', 150)->nullable();
            $table->string('email', 100)->unique();
            $table->string('username', 100)->unique()->nullable();
            $table->string('mobile', 16)->nullable();
            $table->string('password', 200);
            $table->timestamp('email_verified_at')->nullable();
            $table->tinyInteger('role')->default(2)->comment('1:admin, 2:User');
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
