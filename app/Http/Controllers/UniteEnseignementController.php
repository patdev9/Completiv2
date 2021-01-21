<?php

namespace App\Http\Controllers;

use App\Models\Bloc_competence;
use Illuminate\Http\Request;

use App\Models\uniteEnseignement;
use Inertia\Inertia;

class UniteEnseignementController extends Controller
{
    public function index($id){
        $ccp = Bloc_competence::with('uniter')->where('id','=',$id)->get();
        return Inertia::render('admin/uniter',[
            'ccp'=>$ccp,
        ]);
    }


    public function edit($id){
        $ue = uniteEnseignement::with('ccp')->where('id','=',$id)->get();
        return response()->json($ue);
    }

    public function update(Request $request,$id){
       
        $ue = uniteEnseignement::find($id);
        $ue->nom = $request->Nom;
        $ue->Description = $request->Description;
    //    $ue->ccp()->syncWithoutDetaching($request->bloc_competence_id,['Volume_horaire'=>$request->Volume_horaire]);
        $ue->save();
        $p = $request->bloc_competence_id;
    
        return $this->index($p);
    }

    public function store(Request $request){
        
        
        // $v = Validator::make($request->all(), [
        //     'ccp' => ['required', 'string', 'max:255']
        // ])->validate();
        $id = $request['bloc_competence_id'];
        $ue =uniteEnseignement::create([
            'nom'=>$request['nom'],
            'Description'=>$request['Description'],
           // 'bloc_competence_id'=> $request['bloc_competence_id'],
        ]);
        $ccp = Bloc_competence::find($request['bloc_competence_id']);
        $ue->ccp()->attach($ccp,['Volume_horaire'=>$request['Volume_horaire']]);
        return $this->index($id);
    }
    public function destroy($id)
    {
        $p = uniteEnseignement::find($id);
        $id = $p->bloc_competence_id;
        
        uniteEnseignement::find($id)->delete();
      
        return $this->index($id);
    }
}
