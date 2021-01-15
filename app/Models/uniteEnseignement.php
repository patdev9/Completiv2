<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class uniteEnseignement extends Model
{
    use HasFactory;
    protected $fillable = ['bloc_competence_id','nom','Description'];
    public function ccp(){
        return $this->belongsTo(Bloc_competence::class);
    }
}
