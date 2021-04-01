#!/bin/bash

php artisan db:wipe && php artisan migrate

php artisan db:seed --class=MarqueSeeder
php artisan db:seed --class=CategorieSeeder
php artisan db:seed --class=TailleVetementSeeder
php artisan db:seed --class=ProduitSeeder
