<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manualVersenyzok', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('versenyId');
        $table->foreign('versenyId')->references('id')->on('manualVersenyek')->onDelete('cascade');
        $table->string('nev');
        $table->integer('szektor');
        $table->integer('allas');
        $table->double('fogas');
        $table->double('nagyhal');
        $table->time('mazli');
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manualVersenyzok');
    }
};
