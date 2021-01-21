<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class retard extends Model
{
    use HasFactory;
    protected $fillable = ['id','statut','cour_id','user_id','com_pedagogie','com_etudiant','justificatif_id'];

    public function cour(){
        return $this->belongsTo(cour::class);
    }
   
   public function user(){
       return $this->belongsTo(User::class);
   }
}
