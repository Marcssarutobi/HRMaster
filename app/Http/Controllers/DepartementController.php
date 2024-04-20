<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use Illuminate\Http\Request;

class DepartementController extends Controller
{
    public function CreateDep(Request $request){
        $this->validate($request,[
            "name"=>"required",
            "responsable"=>"required",
            "description"=>"required"
        ]);

        $dep = Departement::create([
            "name"=>$request->name,
            "responsable"=>$request->responsable,
            "description"=>$request->description
        ]);

        return response()->json([
            "departement"=> $dep
        ]);
    }

    public function AllDerp(){
        $dep = Departement::orderBy('id','desc')->paginate(6);
        return response()->json([
            "departements"=>$dep
        ]);
    }
    public function show($id){
        $dep = Departement::where('id',$id)->first();
        return response()->json([
            "dep"=>$dep
        ]);
    }
    public function updateDep(Request $request){
        $this->validate($request,[
            "name"=>"required",
            "responsable"=>"required",
            "description"=>"required"
        ]);
        $dep = Departement::where('id',$request->id)->update([
            "name"=>$request->name,
            "responsable"=>$request->responsable,
            "description"=>$request->description
        ]);
        return response()->json(
            [
                "dep"=>$dep
            ]
        );
    }
    public function delDep(Request $request){
      $dep = Departement::where('id',$request->id)->delete();
      
      return response()->json([
        "dep"=>$dep
      ]);
    }
    public function AllDerps(){
        $dep = Departement::orderBy('id','desc')->get();
        return response()->json([
            "deps"=>$dep
        ]);
    }
}
