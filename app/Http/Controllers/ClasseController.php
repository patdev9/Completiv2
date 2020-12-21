<?php

namespace App\Http\Controllers;

use App\Models\classe;
use App\Models\filiere;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClasseController extends Controller
{
    public function index($id){
        $filiere = filiere::find($id);
        $classes = classe::where('filiere_id','=',$id)->with('filiere','etudiant')->get();
        return Inertia::render('admin/classe',[
            'classes'=>$classes,
            'filiere'=>$filiere
        ]);

    }
    public function store(Request $request){
        
        // $v = Validator::make($request->all(), [
        //     'ccp' => ['required', 'string', 'max:255']
        // ])->validate();
        
       $classe = classe::create([
            'nom'=>$request['nom'],
            'filiere_id'=> $request['filiere_id'],
            'user_id'=>'19397'
        ]);
        return $this->index($classe->filiere_id);
    }
    public function destroy($id)
    {
        $p = classe::find($id);
        $filiere_id = $p->filiere_id;
        
        classe::find($id)->delete();
      
        return $this->index($filiere_id);
    }
}
