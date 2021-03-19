<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandeDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commande_detail', function (Blueprint $table) {
            $table->id('commande_detail_id');
            $table->foreignId('commande_entete_id')->references('commande_entete_id')->on('commande_entete');
            $table->foreignId('produit_id')->references('produit_id')->on('produit');
            $table->integer('quantite')->default(1);
            $table->float('prix', 8, 2);
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
        Schema::dropIfExists('commande_detail');
    }
}
