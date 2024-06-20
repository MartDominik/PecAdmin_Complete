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
        Schema::create('hirdetes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userId');
            $table->foreign('userId')->references('id')->on('Users')->onDelete('cascade');
            $table->string('versenynev')->unique();
            $table->string('tipus');
            $table->unsignedBigInteger('helyszinId');
            $table->foreign('helyszinId')->references('id')->on('helyszineks')->onDelete('cascade');
            $table->date('idopont');
            $table->string('rovidleiras', 500);
            $table->string('leiras', 5000);
            $table->string('szabalyzat',5000);
            $table->timestamps();
            $table->softDeletes();
        });
        /*  ALTER TABLE hirdetes MODIFY COLUMN rovidleiras VARCHAR (500);
            ALTER TABLE hirdetes MODIFY COLUMN leiras VARCHAR (5000);
            ALTER TABLE hirdetes MODIFY COLUMN szabalyzat VARCHAR (5000);
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hirdetes');
    }
};
