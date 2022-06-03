<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStikeyMilestonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stikey_milestones', function (Blueprint $table) {
            $table->id();
            $table->string('s_note',2048);
            $table->unsignedBigInteger('milestone_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('milestone_id')->references('id')->on('milestones')->cascadeOnDelete();
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
        Schema::dropIfExists('stikey_milestones');
    }
}
