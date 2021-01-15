<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class promotion_user extends Model
{
    use HasFactory;
    protected $fillable = ['Nom','Description','Annee','Nb_inscrit_formation','Nb_inscrit_titre','taux_reussite','titre_id'];
}
