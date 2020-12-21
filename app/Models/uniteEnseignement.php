<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class uniteEnseignement extends Model
{
    use HasFactory;
    protected $fillable = ['module_enseignement_id','nom'];
    public function ccp(){
        return $this->belongsTo(moduleEnseignement::class);
    }
}
