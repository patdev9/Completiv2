<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class uniteEnseignement extends Model
{
    use HasFactory;
    protected $fillable = ['bloc_competence_id','nom','Description'];
    public function ccp(){
        return $this->belongsToMany(Bloc_competence::class,'bloc_competence_unite_enseignement','ue_id','bloc_competence_id')->withPivot('Volume_horaire');
    }
}
