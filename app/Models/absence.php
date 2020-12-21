<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class absence extends Model
{
    use HasFactory;
    protected $fillable = ['id','statu_id','cour_id','user_id'];

    public function cour(){
        return $this->belongsTo(cour::class);
    }
    public function statut(){
        return $this->belongsTo(statu::class,'statu_id');
    }
}
