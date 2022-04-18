<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        // DB::table('roles')->insert([
        //    array(
        //     'id'=>1,
        //     'name'=>'admin',
        //    ),
        //    array(
        //     'id'=>2,
        //     'name'=>'teacher',
        //    ),
        //    array(
        //     'id'=>3,
        //     'name'=>'student',
        //    )
           

        // ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
