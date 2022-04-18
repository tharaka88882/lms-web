<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_packages', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('streaming_count')->default('0');
            $table->string('description')->nullable();
            // $table->double('price')->default('0');
            $table->decimal('price', 10, 2)->default('0');
            $table->string('color')->nullable();
            $table->boolean('status')->nullable()->default(1);
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
        Schema::dropIfExists('payment_packages');
    }
}
