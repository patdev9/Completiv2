<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FiliereModuleEnseignement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filiere_module_enseignement', function (Blueprint $table) {
            $table->engine = 'InnoDB';
           $table->increments('id');
           $table->bigInteger('filiere_id')->unsigned()->index();
            $table->bigInteger('module_enseignement_id')->unsigned()->index();
            
            
            
            $table->timestamps();
        });
        Schema::table('filiere_module_enseignement', function ($table){
            $table->engine = 'InnoDB';
            $table->foreign('filiere_id')->references('id')->on('filieres')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('filiere_module_enseignement', function ($table){
            $table->engine = 'InnoDB';
            $table->foreign('module_enseignement_id')->references('id')->on('module_enseignements')->onDelete('cascade')->onUpdate('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
