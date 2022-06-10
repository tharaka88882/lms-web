<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQualificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qualifications', function (Blueprint $table) {
            $table->id();
            $table->string('text',2048)->nullable();
            $table->string('location',2048)->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('institute_id');
            $table->timestamps();

            $table->foreign('teacher_id')->references('id')->on('teachers')->cascadeOnDelete();
            $table->foreign('institute_id')->references('id')->on('institutes')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('qualifications');
    }
}
