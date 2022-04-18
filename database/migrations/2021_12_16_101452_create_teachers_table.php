<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('nic')->nullable();
            $table->string('qualification')->nullable();
            $table->string('experience')->nullable();
            $table->string('skills')->nullable();
            $table->decimal('amount', 10, 2)->default(0);
            $table->boolean('status')->default(0);
            $table->boolean('rating')->nullable()->default(0);
            $table->boolean('level')->nullable()->default(1);
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
        Schema::dropIfExists('teachers');
    }
}
