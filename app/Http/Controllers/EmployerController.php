<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;

class EmployerController extends Controller
{
    public function UploadPhoto(Request $request){
        $request->validate([
            "photo"=>"required|image|mimes:jpeg,png,jpg,gif|max:20048"
        ]);

        if ($request->hasFile('photo')) {
           // Génération d'un nom unique pour l'image
            $picName = time() . '.' . $request->file('photo')->extension();

            // Déplacement du fichier vers le répertoire public/images
            $request->file('photo')->move(public_path('images'), $picName);

            // Retourner l'URL de l'image téléchargée
            return response()->json(['image_url' => "/images/$picName"]);
        }else{
            // Aucun fichier image n'a été téléchargé, retourner une erreur
            return response()->json(['error' => "Aucune image n'a été téléchargée."], 400);
        }
    }
    public function CreateEmp(Request $request){
        $this->validate($request,[
            "nom"=>"required",
            "prenom"=>"required",
            "adresse"=>"required",
            "tel"=>"required",
            "email"=>"required",
            "naissance"=>"required",
            "genre"=>"required",
            "departement_id"=>"required",
            "poste_id"=>"required",
            "date_embauche"=>"required",
            "statut"=>"required",
            "salaire"=>"required",
            "info_urgence"=>"required",
            "password"=>"required",
            "photo"=>"required",
        ]);
        $emp = Employer::create([
            "nom"=>$request->nom,
            "prenom"=>$request->prenom,
            "adresse"=>$request->adresse,
            "tel"=>$request->tel,
            "email"=>$request->email,
            "naissance"=>$request->naissance,
            "genre"=>$request->genre,
            "departement_id"=>$request->departement_id,
            "poste_id"=>$request->poste_id,
            "date_embauche"=>$request->date_embauche,
            "statut"=>$request->statut,
            "salaire"=>$request->salaire,
            "info_urgence"=>$request->info_urgence,
            "password"=>$request->password,
            "photo"=>$request->photo,
        ]);
        return response()->json([
            "emp"=>$emp
        ]);
    }
    public function AllEmp(){
        $emp = Employer::orderBy('id','desc')->paginate(6);
        return response()->json([
            "Emps"=>$emp
        ]);
    }
    public function GetEmp($id){
        $emp = Employer::where('id',$id)->first();
        return response()->json([
            "emp"=>$emp
        ]);
    }
    public function UpdateEmp(Request $request){
        $this->validate($request,[
            "nom"=>"required",
            "prenom"=>"required",
            "adresse"=>"required",
            "tel"=>"required",
            "email"=>"required",
            "naissance"=>"required",
            "genre"=>"required",
            "departement_id"=>"required",
            "poste_id"=>"required",
            "date_embauche"=>"required",
            "statut"=>"required",
            "salaire"=>"required",
            "info_urgence"=>"required",
            "password"=>"required",
            "photo"=>"required",
        ]);
        $emp = Employer::where('id',$request->id)->update([
            "nom"=>$request->nom,
            "prenom"=>$request->prenom,
            "adresse"=>$request->adresse,
            "tel"=>$request->tel,
            "email"=>$request->email,
            "naissance"=>$request->naissance,
            "genre"=>$request->genre,
            "departement_id"=>$request->departement_id,
            "poste_id"=>$request->poste_id,
            "date_embauche"=>$request->date_embauche,
            "statut"=>$request->statut,
            "salaire"=>$request->salaire,
            "info_urgence"=>$request->info_urgence,
            "password"=>$request->password,
            "photo"=>$request->photo,
        ]);
        return response()->json([
            "emp"=>$emp
        ]);
    }
    public function DelEmp(Request $request){
        $emp = Employer::where('id',$request->id)->delete();
        return response()->json([
        "emp"=>$emp
      ]);
    }
    public function deleteImage(Request $request, $hasFullPath = false){

        $request->validate([
            'photo'=>'required'
        ]);

        if (!$hasFullPath) {
            $filePath = public_path() .$request->photo;
        }

        if(file_exists($filePath)){
            @unlink($filePath);
        }

        return 'done';

    }
}
