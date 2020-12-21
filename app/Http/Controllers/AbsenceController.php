<?php

namespace App\Http\Controllers;

use App\Models\absence;
use App\Models\classe;
use App\Models\cour;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AbsenceController extends Controller
{
    public function index($id){
        
        $cour = cour::find($id);
        
        
        $users = User::where('classe_id','=',$cour->classe_id)->get();
        
        return Inertia::render('admin/appel',[
            'cour'=>$cour,
            'users'=>$users
        ]);

    }
    public function store(Request $request){
        
        $id = $request[0]['cour_id'];
        $td =$request->request;
        
        foreach ($td as $p){
            absence::create([
                'user_id' => $p['id_user'],
                'cour_id' => $p['cour_id'],
                'statu_id'=>1,
            ]);
            
        }
        return $this->index($id);
        
    }

    public function absence($id){
        $abs = absence::where('user_id','=',$id)->with('cour','statut')->get();
        return Inertia::render('etudiant/mesAbsence',[
            'absences'=>$abs
        ]);
    }
}
