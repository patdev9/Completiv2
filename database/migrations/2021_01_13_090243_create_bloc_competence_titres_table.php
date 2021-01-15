<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlocCompetenceTitresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bloc_competence_titre', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bloc_competence_id')->constrained();
            $table->foreignId('titre_id')->constrained();
            $table->string('Volume_horaire');
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
        Schema::dropIfExists('bloc_competence_titres');
    }
}
