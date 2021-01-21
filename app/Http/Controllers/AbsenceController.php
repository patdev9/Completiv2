<?php

namespace App\Http\Controllers;

use App\Models\absence;
use App\Models\classe;
use App\Models\cour;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\justificatif;
use App\Models\Promotion;
use App\Models\retard;

class AbsenceController extends Controller
{
    public function index($id){
        
        $cour = cour::find($id);   
        $users = Promotion::find($cour->promotion_id)->with('user')->get();
        
        return Inertia::render('admin/appel',[
            'cour'=>$cour,
            'users'=>$users
        ]);
    }
    public function store(Request $request){
              
        $id = $request[0]['cour_id'];
        $td =$request->request;
        $pa= array();
        $abs = array();
        for($i = intval($request[0]['td']);$i < count($request->request);$i++){
            array_push($pa,$request[$i]);
        }
        for($i = 0;$i < intval($request[0]['td']);$i++){
            array_push($abs,$request[$i]);
        }
        foreach ($abs as $p){
            absence::create([
                'user_id' => $p['id_user_abs'],
                'cour_id' => $p['cour_id'],
            ]);
        }
        
        foreach ($pa as $p){
            retard::create([
                'user_id'=>$p['id_user_retard'],
                'cour_id' => $p['cour_id'],
            ]);
        }
        
        return $this->index($id);    
    }
    // public function storeRetard(Request $request){
        
    //     $id = $request[0]['cour_id'];
      
        
    //     return $this->index($id);    
    // }

    public function absence($id){
        $abs = absence::where('user_id','=',$id)->with('cour')->get();
        $retard = retard::where('user_id','=',$id)->with('cour')->get();
        return Inertia::render('etudiant/mesAbsence',[
            'absences'=>$abs,
            'retards'=>$retard
        ]);
    }
    
    public function justifier(Request $request)
    {
        $idu = $request->idu;
        $absence = absence::find($request->idabs);
        $imageName = $request->image->hashName();
        $request->image->move(public_path('absences'),$imageName);
        $justificatif =justificatif::create([
            'libeler'=>$request->libeler,
            'description'=>$request->description,
            'image'=>$imageName
        ]);
        $absence->justificatif_id = $justificatif->id;
        $absence->statu_id=3;
        $absence->save();
        return $this->absence($idu);
    }
}
