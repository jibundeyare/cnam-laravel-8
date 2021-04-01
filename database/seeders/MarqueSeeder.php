<?php

namespace Database\Seeders;

use Faker\Factory as FakerFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarqueSeeder extends Seeder
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

        DB::table('marque')->insert([
            'nom' => 'Foo bar baz',
            'description' => null,
            'created_at' => $createdAt->format('Y-m-d H:i:s'),
        ]);

        for ($i = 0; $i < 9; $i++) {
            $mots_marque = random_int(1, 3);
            
            DB::table('marque')->insert([
                'nom' => $faker->words($mots_marque, true),
                'description' => $faker->paragraph(3),
                'created_at' => $faker->dateTimeBetween('-5 year', '-1 month')->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
