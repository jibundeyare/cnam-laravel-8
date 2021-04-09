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
        // categorie_id : la clé primaire de la table categorie (c-à-d la clé étrangère)
        // produit_id : la clé primaire de la table produit
        return $this->belongsTo(Categorie::class, 'categorie_id', 'produit_id');
    }

    /**
     * Get the marque that owns the produit.
     */
    public function marque()
    {
        // marque_id : la clé primaire de la table marque (c-à-d la clé étrangère)
        // produit_id : la clé primaire de la table produit
        return $this->belongsTo(Marque::class, 'marque_id', 'produit_id');
    }

    /**
     * Get the taille_vetement that owns the produit.
     */
    public function tailleVetement()
    {
        // taille_vetement_id : la clé primaire de la table taille_vetement (c-à-d la clé étrangère)
        // produit_id : la clé primaire de la table produit
        return $this->belongsTo(TailleVetement::class, 'taille_vetement_id', 'produit_id');
    }
}
