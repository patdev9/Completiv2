<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\filiere;

class moduleEnseignement extends Model
{
    use HasFactory;

    protected $fillable = ['module_enseignement_id','CCP'];
    public function filiere(){
        return $this->belongsToMany(filiere::class);
    }
    public function uniter(){
        return $this->hasMany(uniteEnseignement::class);
    } 
}
