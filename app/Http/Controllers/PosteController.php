<?php

namespace App\Http\Controllers;

use App\Models\Poste;
use Illuminate\Http\Request;

class PosteController extends Controller
{
    public function CreatePost(Request $request){
        $this->validate($request,[
            "name"=>"required",
            "departement_id"=>"required",
            "responsabiliter"=>"required",
            "exigences"=>"required",
            "description"=>"required",
            "statut"=>"required"
        ]);
        $poste = Poste::create([
            "name"=> $request->name,
            "departement_id"=>$request->departement_id,
            "responsabiliter"=> $request->responsabiliter,
            "exigences"=>$request->exigences,
            "description"=>$request->description,
            "statut"=>$request->statut
        ]);
        return response()->json([
            "poste"=>$poste
        ]);
    }
    public function AllPoste(){
        $poste = Poste::orderBy('id','desc')->paginate(6);
        return response()->json([
            "postes"=> $poste
        ]);
    }
    public function GetPoste($id){
        $deb = Poste::where('id',$id)->first();
        return response()->json([
            "poste"=>$deb
        ]);
    }
    public function UpdatePoste(Request $request){
        $this->validate($request,[
            "name"=>"required",
            "departement_id"=>"required",
            "responsabiliter"=>"required",
            "exigences"=>"required",
            "description"=>"required",
            "statut"=>"required"
        ]);
        $poste = Poste::where('id',$request->id)->update([
            "name"=> $request->name,
            "departement_id"=>$request->departement_id,
            "responsabiliter"=> $request->responsabiliter,
            "exigences"=>$request->exigences,
            "description"=>$request->description,
            "statut"=>$request->statut
        ]);
        return response()->json([
            "poste"=>$poste
        ]);
    }
    public function DeletePoste(Request $request){
        $poste = Poste::where('id',$request->id)->delete();
        return response()->json([
            "poste"=>$poste
        ]);
    }
    public function Poste(){
        $poste = Poste::orderBy('id','desc')->get();
        return response()->json([
            "postes"=>$poste
        ]);
    }
}
