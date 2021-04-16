<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'produit';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'produit_id';

    /**
     * Get the categorie that owns the produit.
     */
    public function categorie()
    {
        // clé primaire de l'autre table : categorie.categorie_id
        // clé étrangère de cette table : produit.categorie_id
        return $this->belongsTo(Categorie::class, 'categorie_id', 'categorie_id');
    }

    /**
     * Get the marque that owns the produit.
     */
    public function marque()
    {
        // clé primaire de l'autre table : marque.marque_id
        // clé étrangère de cette table : produit.marque_id
        return $this->belongsTo(Marque::class, 'marque_id', 'marque_id');
    }

    /**
     * Get the taille_vetement that owns the produit.
     */
    public function tailleVetement()
    {
        // clé primaire de l'autre table : taille_vetement.taille_vetement_id
        // clé étrangère de cette table : produit.taille_vetement_id
        return $this->belongsTo(TailleVetement::class, 'taille_vetement_id', 'taille_vetement_id');
    }
}
