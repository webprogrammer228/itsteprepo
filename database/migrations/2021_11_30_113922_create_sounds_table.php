<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->nullable();
            $table->timestamps();
        });

        Schema::create('Sounds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 80)->nullable();
            $table->string('artist', 80)->nullable();
            $table->integer('categoryid')->unsigned()->nullable();
            $table->string('imagePath', 255)->nullable();
            $table->string('soundPath', 255)->nullable();
            $table->bigInteger('roleid')->unsigned()->nullable();
            $table->timestamps();


            $table->foreign('categoryid')->references('id')->on('Categories')->onDelete('cascade');
            $table->foreign('roleid')->references('id')->on('Roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sounds');
    }
}
