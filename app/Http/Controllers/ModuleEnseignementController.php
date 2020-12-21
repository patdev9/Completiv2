<?php

namespace App\Http\Controllers;

use App\Models\moduleEnseignement;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;

class ModuleEnseignementController extends Controller
{
    public function index(){
        $ccps = moduleEnseignement::with('filiere')->get();
        return Inertia::render('admin/ccp',[
            'ccps'=>$ccps
        ]);
    }
    public function store(Request $request){
        
        // $v = Validator::make($request->all(), [
        //     'ccp' => ['required', 'string', 'max:255']
        // ])->validate();
        
        moduleEnseignement::create([
            'CCP'=>$request['ccp']
        ]);
        return $this->index();
    }
    public function destroy($id)
    {
        moduleEnseignement::find($id)->delete();
        return $this->index();
    }
}
