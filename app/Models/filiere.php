<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\moduleEnseignement;

class filiere extends Model
{
    use HasFactory;
    protected $fillable = ['filiere_id','nom'];
  
    

    public function ccp(){
        return $this->belongsToMany(moduleEnseignement::class);
    }
    public function classe(){
        return $this->hasMany(classe::class);
    }
}
