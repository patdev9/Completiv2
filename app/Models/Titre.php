<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Titre extends Model
{
    use HasFactory;
    protected $fillable = ['id','nom','Description','Organisme_certificateur','Date_debut_accreditation','Date_renouvellement'];

    public function ccp(){
        return $this->belongsToMany(Bloc_competence::class,'bloc_competence_titre','titre_id','bloc_competence_id')->withPivot('Volume_horaire');
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($titre) { // before delete() method call this
             $titre->ccp()->delete();
             // do the rest of the cleanup...
        });
    }

}
