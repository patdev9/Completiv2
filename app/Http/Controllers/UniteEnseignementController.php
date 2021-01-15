<?php

namespace App\Http\Controllers;

use App\Models\Bloc_competence;
use Illuminate\Http\Request;

use App\Models\uniteEnseignement;
use Inertia\Inertia;

class UniteEnseignementController extends Controller
{
    public function index($id){
        $ccp = Bloc_competence::find($id);
        $uniter = uniteEnseignement::where('bloc_competence_id','=',$id)->with('ccp')->get();
        return Inertia::render('admin/uniter',[
            'ccp'=>$ccp,
            'uniters'=>$uniter
        ]);
    }
    public function store(Request $request){
        
        
        // $v = Validator::make($request->all(), [
        //     'ccp' => ['required', 'string', 'max:255']
        // ])->validate();
        $id = $request['bloc_competence_id'];
        uniteEnseignement::create([
            'nom'=>$request['nom'],
            'Description'=>$request['Description'],
            'bloc_competence_id'=> $request['bloc_competence_id'],
        ]);
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
