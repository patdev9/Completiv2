<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\moduleEnseignement;
use App\Models\uniteEnseignement;
use Inertia\Inertia;

class UniteEnseignementController extends Controller
{
    public function index($id){
        $ccp = moduleEnseignement::find($id);
        $uniter = uniteEnseignement::where('module_enseignement_id','=',$id)->with('ccp')->get();
        return Inertia::render('admin/uniter',[
            'ccp'=>$ccp,
            'uniters'=>$uniter
        ]);
    }
    public function store(Request $request){
        
        
        // $v = Validator::make($request->all(), [
        //     'ccp' => ['required', 'string', 'max:255']
        // ])->validate();
        $id = $request['module_enseignement_id'];
        uniteEnseignement::create([
            'nom'=>$request['nom'],
            'module_enseignement_id'=> $request['module_enseignement_id'],
        ]);
        return $this->index($id);
    }
    public function destroy($id)
    {
        $p = uniteEnseignement::find($id);
        $id = $p->module_enseignement_id;
        
        uniteEnseignement::find($id)->delete();
      
        return $this->index($id);
    }
}
