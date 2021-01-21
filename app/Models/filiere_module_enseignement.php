<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class filiere_module_enseignement extends Model
{
    protected $fillable = ['filiere_id','module_enseignement_id'];
    use HasFactory;

    
}
