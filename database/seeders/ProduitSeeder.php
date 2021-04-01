<?php

namespace Database\Seeders;

use Faker\Factory as FakerFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProduitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create('fr_FR');

        $createdAt = new \DateTime();

        DB::table('produit')->insert([
            'nom' => 'Doudou Lapin Bonbon Taupe',
            'description' => "Le Doudou Lapin Bonbon de Doudou et Compagnie sera rapidement le compagnon favori de votre enfant. Sa petite taille, ses longues oreilles et ses noeuds à mâchouiller le rendront parfaitement adapté aux petites mains de bébé.

            Livré avec une belle boîte cadeau, il sera un cadeau de naissance tout simplement parfait !",
            'prix' => 29.9,
            'actif' => true,
            'quantite' => 30,
            'dimension_largeur' => 10,
            'dimension_longueur' => null,
            'dimension_hauteur' => 20,
            'poids' => 0.3,
            'solde_pourcentage' => 0,
            'categorie_id' => 1,
            'marque_id' => 1,
            'taille_vetement_id' => 1,
            'created_at' => $createdAt->format('Y-m-d H:i:s'),
        ]);

        for ($i = 0; $i < 100; $i++) {
            $mots_marque = random_int(1, 3);

            if (random_int(1, 10) <= 4) {
                // cas 4/10
                $description = $faker->paragraph(3);
            } else {
                // cas 6/10
                $description = null;
            }

            if (random_int(1, 10) <= 2) {
                // cas 2/10
                $actif = false;
            } else {
                // cas 8/10
                $actif = true;
            }

            if (random_int(1, 10) <= 3) {
                // cas 3/10
                $dimensionLongueur = $faker->randomFloat(1, 5, 100);
            } else {
                // cas 7/10
                $dimensionLongueur = null;
            }

            DB::table('produit')->insert([
                'nom' => $faker->words($mots_marque, true),
                'description' => $description,
                'prix' => $faker->randomFloat(2, 10, 100),
                'actif' => $actif,
                'quantite' => random_int(0, 10),
                'dimension_largeur' => $faker->randomFloat(1, 5, 100),
                'dimension_longueur' => $dimensionLongueur,
                'dimension_hauteur' => $faker->randomFloat(1, 5, 100),
                'poids' => $faker->randomFloat(1, 0.1, 10),
                'solde_pourcentage' => 0,
                // les sous-catégories commence à l'id 7 et il y en a 19 en tout
                'categorie_id' => random_int(7, 25),
                'marque_id' => random_int(1, 10),
                // l'id 1 correspond à la taille M
                'taille_vetement_id' => 1,
                'created_at' => $faker->dateTimeBetween('-5 year', '-1 month')->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
