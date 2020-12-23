<?php

namespace App\Http\Controllers;

use App\Models\absence;
use App\Models\classe;
use App\Models\justificatif;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class JustificatifController extends Controller
{

    public function index(){
        
        $classes = classe::with('filiere','etudiant')->get();
        return Inertia::render('admin/absences',[
            'classes'=>$classes
        ]);
    }

    public function show($id){
        
        $user = User::with('absences')->where('classe_id','=',$id)->get();
        return response()->json($user); 
    }

    public function userabs($id){
        $user = User::find($id);
        $absence = absence::with('justificatif','cour','statut')->where('user_id','=',$user->id)->get();

        return Inertia::render('admin/userabs',[
            'absence'=>$absence,
            'user'=>$user
        ]);
    }
    public function justificatif($id){
        $just = justificatif::find($id);
        return response()->json($just); 
    }
}
