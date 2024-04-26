<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    use HasFactory;

    protected $fillable = ["nom","prenom","adresse","tel","email","naissance","genre","departement_id","poste_id","date_embauche","statut","salaire","info_urgence","password","photo"];

    public function departement(){
        return $this->belongsTo(Departement::class);
    }
    public function Poste(){
        return $this->belongsTo(Poste::class);
    }
}
