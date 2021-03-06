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
            $table->string('name');
            $table->string('email')->unique();
            $table->string('image')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('address')->nullable();
            $table->string('about',2048)->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->date('from_leave')->default('1994-10-02');
            $table->date('to_leave')->default('1994-10-02');
            $table->boolean('leave_status')->default(0);
            $table->string('avg')->default(5);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password',2048);
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->string('social_id', 2048)->nullable();
            $table->string('social_type', 2048)->nullable();
            $table->string('company', 2048)->nullable();
            $table->boolean('first_login')->default(0);
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
