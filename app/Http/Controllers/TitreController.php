<?php

namespace App\Http\Controllers;

use App\Models\Bloc_competence;
use App\Models\Titre;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TitreController extends Controller
{
    
    public function index(){
        $titres=Titre::with('ccp')->get();
        $ccps =Bloc_competence::get();
        return Inertia::render('admin/titre',[
            'titres'=>$titres,
            'ccps'=>$ccps
        ]);
    }

    public function store(Request $request){
        Titre::create([
            'nom'=>$request->nom,
            'Description'=>$request->Description,         
            'Organisme_certificateur'=>$request->Organisme_certificateur,         
            'Date_debut_accreditation'=>$request->Date_debut_accreditation,         
            'Date_renouvellement'=>$request->Date_renouvellement        
        ]);
        return $this->index();
    }
    public function destroy($id){
        Titre::find($id)->delete();
        return $this->index();
    }
}