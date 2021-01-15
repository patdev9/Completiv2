<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('cour_id')->constrained();
            $table->enum('statut',['Nouveau','en attente de justificatif','Justificatif en attente d approbation','Justificatif rejeté','Justificatif approuvé'])->default('Nouveau');
            $table->text('Justificatif')->nullable();
            $table->text('com_pedagogie')->nullable();
            $table->text('com_etudiant')->nullable();
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
        Schema::dropIfExists('absences');
    }
}
