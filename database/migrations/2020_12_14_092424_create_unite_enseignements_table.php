<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUniteEnseignementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unite_enseignements', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->text('Description');
          //  $table->foreignId('bloc_competence_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     * 
     */
    public function down()
    {
        Schema::dropIfExists('unite_enseignements');
    }
}
