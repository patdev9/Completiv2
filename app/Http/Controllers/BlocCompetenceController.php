<?php

namespace App\Http\Controllers;

use App\Models\Bloc_competence;
use App\Models\Titre;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BlocCompetenceController extends Controller
{
    public function index(){
        $ccps = Bloc_competence::get();
        return Inertia::render('admin/ccp',[
            'ccps'=>$ccps
        ]);
    }
    public function store(Request $request){
        
        // $v = Validator::make($request->all(), [
        //     'ccp' => ['required', 'string', 'max:255']
        // ])->validate();
        
        Bloc_competence::create([
            'Nom'=>$request['Nom'],
            'Description'=>$request['Description']
        ]);
        return $this->index();
    }
    public function destroy($id)
    {
        Bloc_competence::find($id)->delete();
        return $this->index();
    }
}
