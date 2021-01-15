<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Titre extends Model
{
    use HasFactory;
    protected $fillable = ['id','nom','Description','Organisme_certificateur','Date_debut_accreditation','Date_renouvellement'];

    public function ccp(){
        return $this->belongsToMany(Bloc_competence::class);
    }
}
