<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produit', function (Blueprint $table) {
            $table->id('produit_id');
            $table->string('nom', 100);
            $table->text('description')->nullable();
            $table->float('prix', 8, 2);
            $table->boolean('actif')->default(true);
            $table->foreignId('categorie_id');
            $table->foreignId('marque_id');
            $table->integer('quantite')->default(1);
            // default(1) correspond à la taille M
            $table->foreignId('taille_vetement_id')->default(1);
            $table->float('dimension_largeur', 8, 2)->nullable();
            $table->float('dimension_longueur', 8, 2)->nullable();
            $table->float('dimension_hauteur', 8, 2)->nullable();
            $table->float('poids', 8, 2)->nullable();
            $table->integer('solde_pourcentage');
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
        Schema::dropIfExists('produit');
    }
}
