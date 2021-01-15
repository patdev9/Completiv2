<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlocCompetenceUniteEnseignementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bloc_competence_unite_enseignement', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bloc_competence_id')->constrained();
            $table->unsignedBigInteger('ue_id');
            $table->string('Volume_horaire');
            $table->timestamps();
            $table->foreign('ue_id')->references('id')->on('unite_enseignements')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bloc_competence_unite_enseignements');
    }
}
