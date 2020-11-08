<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->unique();
            $table->string('mobile',16)->nullable();
            $table->date('dob')->nullable();
            $table->enum('gender', ['male','female','other'])->nullable();
            $table->string('profile_photo',100)->nullable();
            $table->text('address')->nullable();
            $table->text('about')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_profiles');
    }
}
