<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categorie';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'categorie_id';

    /**
     * Get the produits for the blog categorie.
     */
    public function produits()
    {
        // clé étrangère de l'autre table : produit.categorie_id
        // clé primaire de cette table : categorie.categorie_id
        return $this->hasMany(Produit::class, 'categorie_id', 'categorie_id');
    }
}
