<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cour extends Model
{
    use HasFactory;
    protected $fillable = ['id','date_start','date_end','user_id','promotion_id','bloc_competence_id','unite_enseignement_id'];
    
    public function formateur(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function ccp(){
        return $this->belongsTo(Bloc_competence::class,);
    }
    public function classe(){
        return $this->belongsTo(Promotion::class,'promotion_id');
    }
    public function uniter(){
        return $this->belongsTo(uniteEnseignement::class,'unite_enseignement_id');
    }
    
    
}
