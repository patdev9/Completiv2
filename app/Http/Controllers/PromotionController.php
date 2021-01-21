<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use App\Models\Titre;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PromotionController extends Controller
{
    public function index(){
        
        $classes = Promotion::with('titre','user')->get();
        $titres = Titre::get();
        return Inertia::render('admin/promotion',[
            'classes'=>$classes,
            'titres'=>$titres
        ]);

    }
    public function edit($id){
        $promotion = Promotion::find($id);
        return response()->json($promotion);
    }

    public function update(Request $request,$id){
       
        $promotion = Promotion::find($id);
        $promotion->Nom = $request->Nom;
        $promotion->Description = $request->Description;
        $promotion->Annee = $request->Annee;
        $promotion->Nb_inscrit_formation = $request->inscritF;
        $promotion->Nb_inscrit_titre = $request->inscritT;
        $promotion->taux_reussite = $request->taux;
        $promotion->save();
       
        return $this->index();
    }
    public function store(Request $request){
        
        // $v = Validator::make($request->all(), [
        //     'ccp' => ['required', 'string', 'max:255']
        // ])->validate();
        
       $classe = Promotion::create([
            'Nom'=>$request['Nom'],
            'Description'=>$request['Description'],
            'Annee'=>$request['Annee'],
            'titre_id'=>$request['titre_id']
        ]);
        return $this->index();
    }
    public function destroy($id)
    {
        Promotion::find($id)->delete();   
        return $this->index();
    }
}
