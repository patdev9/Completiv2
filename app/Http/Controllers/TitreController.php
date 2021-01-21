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

    public function edit($id){

        $titres = Titre::find($id);
        return response()->json($titres);
    }

    public function update(Request $request,$id){
       
        $titre = Titre::find($id);
        $titre->Nom = $request->nom;
        $titre->Description = $request->Description;
        $titre->Organisme_certificateur=$request->Organisme_certificateur;
        $titre->Date_debut_accreditation=$request->Date_debut_accreditation;
        $titre->Date_renouvellement=$request->Date_renouvellement;
        $titre->save();
        return $this->index();
    }

    public function titreGet(){
        $titres = Titre::all();
        return response()->json($titres);
    }

    public function store(Request $request){
        
       $titre = Titre::create([
            'nom'=>$request->nom,
            'Description'=>$request->Description,         
            'Organisme_certificateur'=>$request->Organisme_certificateur,         
            'Date_debut_accreditation'=>$request->Date_debut_accreditation,         
            'Date_renouvellement'=>$request->Date_renouvellement        
        ]);
        for($i=0; $i < count($request->request);$i++){
            $ccp = Bloc_competence::find($request[$i]);
            $titre->ccp()->attach($ccp);
        }
        return $this->index();
    }
    public function destroy($id){
        Titre::find($id)->delete();
        return $this->index();
    }
}