<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rating_views', function (Blueprint $table) {
            $table->id();
            $table->string('r_count')->default(1);
            $table->boolean('status')->nullable();
            $table->unsignedBigInteger('mentor_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('mentor_id')->references('id')->on('teachers')->cascadeOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rating_views');
    }
}
