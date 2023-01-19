<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuchungenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buchungen', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->time('start');
            $table->time('ende');
            $table->date('datum');
            $table->text('notiz');
            $table->integer('raum');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buchungen');
    }
}
