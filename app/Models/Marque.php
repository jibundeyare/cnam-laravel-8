<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marque extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'marque';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'marque_id';

    /**
     * Get the produits for the blog marque.
     */
    public function produits()
    {
        // clé étrangère de l'autre table : produit.marque_id
        // clé primaire de cette table : marque.marque_id
        return $this->hasMany(Produit::class, 'marque_id', 'marque_id');
    }
}
