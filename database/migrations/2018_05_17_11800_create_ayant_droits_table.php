<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAyantDroitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bdn_ayant_droit', function (Blueprint $table) {
			
            $table->increments('BDN_AYANT_DROIT_ID');
			$table->integer('BDN_PROFIL_UTILISATEUR_ID');
			$table->integer('BDN_GENRE_OEUVRE_ID');
			$table->string('BDN_SOCIETE_ID');
			$table->string('BDN_AYANT_DROIT_BDN_UTILISATEUR_MATRICULE');
			$table->string('BDN_TYPE_PERSONNE_ID');
			$table->integer('BDN_PAYS_ID');
			$table->integer('BDN_BANQUE_ID');
			$table->string('BDN_AYANT_DROIT_NUMERO_CARTE');
			$table->string('BDN_AYANT_DROIT_COMPTE_GENERAL_DROIT');
			$table->string('BDN_AYANT_DROIT_COMPTE_AUXILIAIRE_DROIT');
			$table->string('BDN_AYANT_DROIT_COMPTE_GENERAL_RETRAITE');
			$table->string('BDN_AYANT_DROIT_COMPTE_AUXILIAIRE_RETRAITE');
			$table->string('BDN_AYANT_DROIT_CODE_COMPTABLE');
			$table->string('BDN_AYANT_DROIT_NUM_IPI');
			$table->string('BDN_AYANT_DROIT_NUM_IPI_TEST');
			$table->string('BDN_AYANT_DROIT_NUM_IPI_PSEUDONYME');
			$table->string('BDN_AYANT_DROIT_NUM_IPI_PATRONYME');
			$table->decimal('BDN_AYANT_DROIT_SOLDE');
			$table->string('BDN_AYANT_DROIT_PRET_SOLDE');
			$table->string('BDN_AYANT_DROIT_RAISON_SOCIALE');
			$table->string('BDN_AYANT_DROIT_PSEUDONYME');
			$table->string('BDN_AYANT_DROIT_LOGIN');
			$table->string('BDN_AYANT_DROIT_MOT_DE_PASSE');
			$table->string('BDN_AYANT_DROIT_NATURE_PIECE');
			$table->string('BDN_AYANT_DROIT_NUMERO_PIECE');
			$table->string('BDN_AYANT_DROIT_DATE_NAISSANCE');
			$table->string('BDN_AYANT_DROIT_LIEU_NAISSANCE');
			$table->string('BDN_AYANT_DROIT_CIVILITE');
			$table->string('BDN_AYANT_DROIT_SEXE');
			$table->string('BDN_AYANT_DROIT_COMPTE_BANCAIRE');
			$table->string('BDN_AYANT_DROIT_TELEPHONE_MOBILE');
			$table->string('BDN_AYANT_DROIT_TELEPHONE_BUREAU');
			$table->string('BDN_AYANT_DROIT_ADRESSE_POSTALE');
			$table->string('BDN_AYANT_DROIT_ADRESSE_GEOGRAPHIQUE');
			$table->string('BDN_AYANT_DROIT_EMAIL');
			$table->string('BDN_AYANT_DROIT_SITE_WEB');
			$table->string('BDN_AYANT_DROIT_PHOTO');
			$table->string('BDN_AYANT_DROIT_NOM_PERE');
			$table->string('BDN_AYANT_DROIT_NOM_MERE');
			$table->string('BDN_AYANT_DROIT_FICHIER_DOSSIER');
			$table->string('BDN_AYANT_DROIT_SITUATION_JURIDIQUE');
			$table->string('BDN_AYANT_DROIT_BDN_PAYS_NOM');
			$table->string('BDN_AYANT_DROIT_BDN_TYPE_PERSONNE_LIBELLE');
			$table->string('BDN_AYANT_DROIT_BDN_BANQUE_LIBELLE');
			$table->string('BDN_AYANT_DROIT_DATE_DECES');
			$table->string('BDN_AYANT_DROIT_DATE_AFFILIATION');
			$table->string('BDN_AYANT_DROIT_DATE_CREATION');
			$table->string('BDN_AYANT_DROIT_DATE_MODIFICATION');
			$table->string('BDN_AYANT_DROIT_DATE_SUPPRESSION');
			$table->string('BDN_AYANT_DROIT_STATUT_CARTE');
			$table->string('BDN_AYANT_DROIT_STATUT_RETRAITE');
			$table->string('BDN_AYANT_DROIT_STATUT_MEMBRE');
			$table->string('BDN_AYANT_DROIT_STATUT');
			$table->string('ayant_droit_cc');
			$table->string('ayant_droit_membre');
			$table->string('ayant_droit_date_adhesion');
			$table->string('ayant_droit_carte_salaire');
			$table->string('ayant_droit_carte_retiree');
			$table->string('ayant_droit_sexe');
			$table->string('MG');
			$table->string('MARQUE_DOUBLON');
			$table->string('RANGEMENT');
			$table->string('RAISONSOCIALE');
			$table->string('DATE_AFFILIATION_EDJA');
			$table->string('x_ad_1_8000');
			$table->string('RAISONSOCIALE2');
			$table->string('TRAITEMENT2');
			$table->string('SEXE');

            // $table->timestamps();
			
			
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ayant_droits');
    }
}
