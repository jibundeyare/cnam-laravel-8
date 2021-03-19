<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProduitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produit', function (Blueprint $table) {
            $table->foreign('categorie_id')->references('categorie_id')->on('categorie');
            $table->foreign('marque_id')->references('marque_id')->on('marque');
            $table->foreign('taille_vetement_id')->references('taille_vetement_id')->on('taille_vetement');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produit', function (Blueprint $table) {
            $table->dropForeign('produit_taille_vetement_id_foreign');
            $table->dropForeign('produit_marque_id_foreign');
            $table->dropForeign('produit_categorie_id_foreign');
        });
    }
}
