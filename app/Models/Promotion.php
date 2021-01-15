<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    protected $fillable = ['Nom','Description','Annee','Nb_inscrit_formation','Nb_inscrit_titre','taux_reussite','titre_id'];

    public function user(){
        return $this->belongsToMany(User::class);
    }
    public function titre(){
        return $this->belongsTo(Titre::class);
    }
}
