<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poste extends Model
{
    use HasFactory;

    protected $fillable = ["name","description","responsabiliter","exigences","statut","departement_id"];

    public function departement(){
        return $this->belongsTo(Departement::class);
    }
}
