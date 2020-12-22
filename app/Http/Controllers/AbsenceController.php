<?php

namespace App\Http\Controllers;

use App\Models\absence;
use App\Models\classe;
use App\Models\cour;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\justificatif;

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
        $absence->statu_id =3;
        $absence->save();
        return $this->absence($idu);
       
    }
}
