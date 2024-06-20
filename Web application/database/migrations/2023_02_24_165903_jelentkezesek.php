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
        Schema::create('jelentkezs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hirdetId');
            $table->foreign('hirdetId')->references('id')->on('hirdetes')->onDelete('cascade');
            $table->string('nev');
            $table->string('telefonszam');
            $table->string('email');
            //talan ket/harom nullazhato intel megoldhato a versenykezeles (megoldva)
            $table->integer('szektor')->nullable();
            $table->integer('allas')->nullable();
            $table->double('fogas')->default(0);
            $table->double('nagyhal')->default(0);
            $table->time('mazli')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jelentkezs');
    }
};
