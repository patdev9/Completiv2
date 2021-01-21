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

    public function edit($id){
        $user = User::find($id);
        return response()->json($user);
    }

    public function update(Request $request,$id){
      
        $id = $request['classe_id'];
        $user = User::find($id);
        
        $user->Nationalite = $request->Nationalite;
        $user->forceFill([
            'nom'=>$request->nom,
            'prenom'=>$request->prenom,
            'Nationalite'=>$request->Nationalite
        ])->save();
        
       
        return $this->classeuser($id);
    }

    public function test(){
        return Inertia::render('admin/test2');
    }

    public function storeOne(Request $request){
        
        
        $id = $request['classe_id'];
        $pass = $request['password'];
        $user =User::create([
            'nom' => $request['nom'],
                'prenom' => $request['prenom'],
                'email' => $request['email'],
                'Date_naissance' => $request['Date_naissance'],
                'Lieu_naissance' => $request['Lieu_naissance'],
                'Nationalite' => $request['Nationalite'],
                'password' => Hash::make($pass),
        ]);
        $user->promotion()->attach($id,['inscrit_formation'=>true,'inscrit_titre'=>true]);
        return $this->classeuser($id);

    }
    public function destroy($id)
    {
        $p = User::with('promotion')->where('id','=',$id)->get();
        
        $classeId = $p[0]->promotion[0]->id; 
        
        User::find($id)->delete();
      
        return $this->classeuser($classeId);
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
