<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profession', function (Blueprint $table) {
            $table->increments('PROFESSION_ID');
            $table->string('PROFESSION_LIBELLE');
            $table->string('PROFESSION_DATE_CREATION');
            $table->string('PROFESSION_DATE_MODIFICATION');
            $table->string('PROFESSION_DATE_SUPPRESSION');
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
        Schema::dropIfExists('profession');
    }
}
