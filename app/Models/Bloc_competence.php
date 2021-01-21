<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bloc_competence extends Model
{
    use HasFactory;
    protected $fillable=['id','Nom','Description'];

    public function titre(){
       return $this->belongsToMany(Titre::class,'bloc_competence_titre','bloc_competence_id','titre_id')->withPivot('Volume_horaire');
    }
    public function uniter(){
        return $this->belongsToMany(uniteEnseignement::class,'bloc_competence_unite_enseignement','bloc_competence_id','ue_id')->withPivot('Volume_horaire');
    }
}
