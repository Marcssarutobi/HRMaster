<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;
    protected $fillable = ["name","responsable","description"];

    public function Poste(){
        return $this->hasMany(Poste::class);
    }
    public function Employer(){
        return $this->hasMany(Employer::class);
    }
}
