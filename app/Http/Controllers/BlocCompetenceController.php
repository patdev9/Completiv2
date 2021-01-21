<?php

namespace App\Http\Controllers;

use App\Models\Bloc_competence;
use App\Models\Titre;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BlocCompetenceController extends Controller
{
    public function index(){
        $ccps = Bloc_competence::with('titre')->get();
        return Inertia::render('admin/ccp',[
            'ccps'=>$ccps
        ]);
    }

    public function edit($id){
        $ccp = Bloc_competence::find($id)->with('titre')->get();
        return response()->json($ccp);
    }
    public function titreGet(){
        $titres = Titre::all();
        return response()->json($titres);
    }

    public function update(Request $request,$id){
       
        $ccp = Bloc_competence::find($id);
        $ccp->Nom = $request->Nom;
        $ccp->description = $request->Description;
        $ccp->titre()->detach($request->titreid,['Volume_horaire'=>$request->Volume_horaire]);
        $ccp->titre()->attach($request->titreid,['Volume_horaire'=>$request->Volume_horaire]);
        $ccp->save();
        return $this->index();
    }

    public function store(Request $request){
        
        // $v = Validator::make($request->all(), [
        //     'ccp' => ['required', 'string', 'max:255']
        // ])->validate();
        
       $ccp= Bloc_competence::create([
            'Nom'=>$request['Nom'],
            'Description'=>$request['Description']
        ]);
        $titre = Titre::find($request->titreid);
        $ccp->titre()->attach($titre,['Volume_horaire'=>$request->Volume_horaire]);
        return $this->index();
    }
    public function destroy($id)
    {
        Bloc_competence::find($id)->delete();
        return $this->index();
    }
}
