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
        Schema::create('manualVersenyek', function (Blueprint $table) {
            $table->id();
            $table->string('versenynev')->unique();
            $table->unsignedBigInteger('helyszinid');
            $table->foreign('helyszinId')->references('id')->on('helyszineks')->onDelete('cascade');
            $table->date('idopont');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manualVersenyek');
    }
};
