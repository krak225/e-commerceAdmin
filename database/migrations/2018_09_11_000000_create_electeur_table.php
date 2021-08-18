<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElecteurTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('electeur', function (Blueprint $table) {
            $table->increments('ELECTEUR_ID');
            $table->integer('UTILISATEUR_ID');
            $table->integer('CIRCONSCRIPTION_ID');
            $table->integer('PROFESSION_ID');
            $table->string('ELECTEUR_NOM');
            $table->string('ELECTEUR_PRENOMS');
            $table->string('ELECTEUR_SEXE');
            $table->string('ELECTEUR_DATE_NAISSANCE');
            $table->string('ELECTEUR_LIEU_NAISSANCE');
            $table->string('ELECTEUR_NUMERO_CNI');
            $table->string('ELECTEUR_NUMERO_CARTE_ELECTEUR');
            $table->string('ELECTEUR_EMAIL');
            $table->string('ELECTEUR_TELEPHONE');
            $table->string('ELECTEUR_DOMICILE');
            $table->string('ELECTEUR_QUARTIER');
            $table->string('ELECTEUR_PROFESSION_LIBELLE');
            $table->string('ELECTEUR_DATE_CREATION');
            $table->string('ELECTEUR_DATE_MODIFICATION');
            $table->string('ELECTEUR_DATE_SUPPRESSION');
            $table->string('ELECTEUR_STATUT');
			
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('electeur');
    }
}
