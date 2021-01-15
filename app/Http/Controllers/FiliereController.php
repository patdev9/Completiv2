<?php

namespace App\Http\Controllers;

use App\Models\filiere;
use App\Models\moduleEnseignement;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\DB;
use App\Models\filiere_module_enseignement;

class FiliereController extends Controller
{
    public function index(){
        $filieres=filiere::with('ccp')->get();
        $ccps =moduleEnseignement::get();
        
        return Inertia::render('admin/index',[
            'filieres'=>$filieres,
            'ccps'=>$ccps
        ]);
    }
    public function store(Request $request){
         
         $input = ['nom'=> $request['nom']];
         $filiere = filiere::create($input);
        
        for($i=0; $i < count($request->request);$i++){
            $ccp = moduleEnseignement::find($request[$i]);
            $filiere->ccp()->attach($ccp);
        }
        return $this->index();     
    }
    public function destroy($id)
    {
        filiere::find($id)->delete();
        return $this->index();
    }
}
