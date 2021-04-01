<?php

namespace Database\Seeders;

use Faker\Factory as FakerFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorieSeeder extends Seeder
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

        // 6 catégories racines
        DB::table('categorie')->insert([
            'nom' => 'Lorem ipsum',
            'categorie' => null,
            'created_at' => $createdAt->format('Y-m-d H:i:s'),
        ]);

        for ($i = 0; $i < 5; $i++) {
            $mots = random_int(1, 3);

            DB::table('categorie')->insert([
                'nom' => $faker->words($mots, true),
                'categorie' => null,
                'created_at' => $faker->dateTimeBetween('-5 year', '-1 month')->format('Y-m-d H:i:s'),
            ]);
        }

        // 19 sous-catégories
        for ($i = 0; $i < 19; $i++) {
            $mots = random_int(1, 3);

            DB::table('categorie')->insert([
                'nom' => $faker->words($mots, true),
                // les id des catégories racines démarrent à 1 et s'arrêtent à 6
                'categorie' => random_int(1, 6),
                'created_at' => $faker->dateTimeBetween('-5 year', '-1 month')->format('Y-m-d H:i:s'),
            ]);
        }

    }
}
