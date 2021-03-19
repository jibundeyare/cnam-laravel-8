<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUtilisateurTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('utilisateur', function (Blueprint $table) {
            $table->id('utilisateur_id');
            $table->string('email', 100)->unique();
            $table->enum('role', ['administrateur', 'utilisateur'])->default('utilisateur');
            $table->string('mot_de_passe', 100);
            $table->string('tel', 100)->nullable();
            $table->string('nom', 100)->nullable();
            $table->string('prenom', 100)->nullable();
            $table->text('adresse1')->nullable();
            $table->text('adresse2')->nullable();
            $table->string('localite', 100)->nullable();
            $table->integer('code_postal')->nullable();
            $table->boolean('actif')->default(true);
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
        Schema::dropIfExists('utilisateur');
    }
}
