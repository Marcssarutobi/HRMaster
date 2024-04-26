<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employers', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('adresse');
            $table->string('tel');
            $table->string('email');
            $table->date('naissance');
            $table->string('genre');
            $table->foreignId('departement_id')->constrained('departements');
            $table->foreignId('poste_id')->constrained('postes');
            $table->date('date_embauche');
            $table->string('statut');
            $table->string('salaire');
            $table->string('info_urgence');
            $table->string('password');
            $table->string('photo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employers');
    }
};
