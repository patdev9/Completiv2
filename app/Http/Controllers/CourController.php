<?php

namespace App\Http\Controllers;

use App\Models\Bloc_competence;
use App\Models\classe;
use App\Models\cour;
use App\Models\moduleEnseignement;
use App\Models\Promotion;
use App\Models\uniteEnseignement;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $classe = Promotion::find($id);
        $ccps = Bloc_competence::get();
        $cours = cour::where('promotion_id','=',$id)->with('ccp','uniter')->get();
        return Inertia::render('admin/edt',[
            'classe'=>$classe,
            'cours'=>$cours,
            'ccps'=>$ccps
        ]);
    }
    public function units($id){
        $units = Bloc_competence::where('id','=',$id)->with('uniter')->get();
        return response()->json($units);
    }
    public function user(){
        $user = User::where('role_id','=',2)->get();
        return response()->json($user);
    }

    public function classes(){
        $classes = Promotion::get();
        return Inertia::render('admin/planing',[
            'classes'=>$classes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $id = $request['classe_id'];
       
         cour::create([
            'date_start'=> $request['start'],
            'date_end'=> $request['end'],
            'user_id'=> $request['id_formateur'],
            'unite_enseignement_id'=> $request['unit_id'],
            'promotion_id'=> $request['classe_id'],
        ]);
        return $this->index($id);        
    }

    public function details($id){
        $cour = cour::with('ccp','classe','formateur','uniter')->find($id);
        
        return response()->json($cour); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cour  $cour
     * @return \Illuminate\Http\Response
     */
    public function show(cour $cour)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cour  $cour
     * @return \Illuminate\Http\Response
     */
    public function edit(cour $cour)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cour  $cour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cour $cour)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cour  $cour
     * @return \Illuminate\Http\Response
     */
    public function destroy(cour $cour)
    {
        //
    }
}
