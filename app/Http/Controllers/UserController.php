<?php

namespace App\Http\Controllers;

use App\Models\classe;
use App\Models\Promotion;
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
        $classe = Promotion::where('id','=',$id)->with('user')->get();
        
        return Inertia::render('admin/classeUser',[
            'classe'=>$classe,
         
        ]);
    }

    public function test(){
        return Inertia::render('admin/test2');
    }

    public function store(Request $request){
        
       
        $id = $request[0]['classe_id'];
        $td =$request->request;
        foreach ($td as $p){
            $pass = $p['password'];
           $user= User::create([
                'nom' => $p['nom'],
                'prenom' => $p['prenom'],
                'email' => $p['email'],
                'Date_naissance' => $p['Date_naissance'],
                'Lieu_naissance' => $p['Lieu_naissance'],
                'Nationalite' => $p['Nationalite'],
                'password' => Hash::make($pass),
            ]);
            
            $user->promotion()->attach($id,['inscrit_formation'=>true,'inscrit_titre'=>true]);
            
        }
        return $this->classeuser($id);
        
    }
}
