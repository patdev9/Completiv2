<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bloc_competence extends Model
{
    use HasFactory;
    protected $fillable=['id','Nom','Description'];

    public function titre(){
       return $this->belongsToMany(Titre::class);
    }
    public function uniter(){
        return $this->belongsToMany(uniteEnseignement::class);
    }
}
