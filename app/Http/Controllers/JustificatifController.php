<?php

namespace App\Http\Controllers;

use App\Models\absence;
use App\Models\classe;
use App\Models\justificatif;
use App\Models\Promotion;
use App\Models\User;
use ArrayObject;
use Illuminate\Http\Request;
use Inertia\Inertia;

class JustificatifController extends Controller
{

    public function index(){
        
        $classes = Promotion::with('titre','user')->get();
        return Inertia::render('admin/absences',[
            'classes'=>$classes
        ]);
    }

    public function show($id){
        $classe= Promotion::find($id)->with('user')->get();
        $us= new ArrayObject();

        for($i=0;$i <$classe[0]['user']->count();$i++){
           
            $us->append(User::where('id','=',$classe[0]['user'][$i]['id'])->with('absences')->get());
        }
        $user = User::with('absences','promotion')->get();
        
        return response()->json($us); 
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

    public function maquette(){
        return Inertia::render('admin/maquette');
    }
}
