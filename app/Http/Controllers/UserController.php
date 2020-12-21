<?php

namespace App\Http\Controllers;

use App\Models\classe;
use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $users = User::with('role')->get();      
        return Inertia::render('admin/user',[
            'users'=>$users
        ]);
    }
    public function classeuser($id){
        $classe = classe::find($id);
        $users = User::where('classe_id','=',$id)->get();
        return Inertia::render('admin/classeUser',[
            'classe'=>$classe,
            'users'=>$users
        ]);
    }

    public function test(){
        return Inertia::render('admin/test2');
    }

    public function store(Request $request){
        
        $id = $request[0]['classe_id'];
        $td =$request->request;
        
        foreach ($td as $p){
            User::create([
                'nom' => $p['nom'],
                'prenom' => $p['prenom'],
                'email' => $p['email'],
                'password' => Hash::make($p['password']),
                'classe_id'=>$p['classe_id']
            ]);
            
        }
        return $this->classeuser($id);
        
    }
}
