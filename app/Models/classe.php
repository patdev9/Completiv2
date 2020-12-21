<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class classe extends Model
{
    use HasFactory;

    protected $fillable = ['id','filiere_id','nom','user_id'];

    public function filiere(){
        return $this->belongsTo(filiere::class);
    }
    public function etudiant(){
        return $this->hasMany(User::class);
    }
}
