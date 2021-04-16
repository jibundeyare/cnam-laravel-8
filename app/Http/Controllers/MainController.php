<?php

namespace App\Http\Controllers;

use App\Models\Marque;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index()
    {
        $name = 'Foo';

        return view('main.index', [
            'title' => $name,
        ]);
    }

    public function test()
    {
        // méthode moderne avec l'orm eloquent
        foreach (Marque::all() as $marque):
            ?>
            marque: <?= $marque->nom ?><br>
            <?php
            foreach ($marque->produits()->get() as $produit):
                ?>
                produit: <?= $produit->nom ?><br>
                <?php
            endforeach;
            ?>
            <br>
            <?php
        endforeach;

        foreach (Produit::all() as $produit):
            ?>
            produit: <?= $produit->nom ?><br>
            marque: <?= $produit->marque->nom ?><br>
            <br>
            <?php
        endforeach;

        // méthode old school avec une requête sql
        $sql = 'SELECT marque.marque_id, marque.nom AS marque_nom, produit.produit_id, produit.nom AS produit_nom
        FROM marque
        INNER JOIN produit ON produit.marque_id = marque.marque_id';
        $rows = DB::select($sql);

        // echo '<pre>';
        // var_dump($marques);
        // echo '</pre>';

        $marque_id_precedent = 0;

        foreach ($rows as $row):
            ?>
            <?php if ($row->marque_id != $marque_id_precedent): ?>
            <h2><?= $row->marque_id ?> <?= $row->marque_nom ?></h2>
            <?php endif ?>
            <p>
                - <?= $row->produit_id ?> <?= $row->produit_nom ?>
            </p>
            <?php
            $marque_id_precedent = $row->marque_id;
        endforeach;

        exit();

        // recherche par mot clé dans le nom ou la description
        $keyword = 'lorem';

        $produits = Produit::where('nom', 'like', "%$keyword%")
            ->orWhere('description', 'like', "%$keyword%")
            ->get();

        foreach ($produits as $produit):
            ?>
            <?= $produit->nom ?> <?= substr($produit->description, 0, 50) ?><?php if (strlen($produit->description) > 50):?>...<?php endif?><br>
            <?php
        endforeach;

        echo '<br>';

        // recherche par fourchette de prix
        $lowerLimit = 10.0;
        $upperLimit = 20.0;

        $produits = Produit::where('prix', '>=', $lowerLimit)
        ->where('prix', '<=', $upperLimit)
        ->get();

        foreach ($produits as $produit):
            ?>
            <?= $produit->nom ?> <?= $produit->prix ?><br>
            <?php
        endforeach;

        echo '<br>';

        // recherche par fourchette de prix
        // et recherche par mot clé dans le nom ou la description
        $keyword = 'lorem';

        $produits = Produit::where('prix', '>=', $lowerLimit)
            ->where('prix', '<=', $upperLimit)
            ->where(function ($query) use ($keyword) {
                $query->where('nom', 'like', "%$keyword%")
                ->orWhere('description', 'like', "%$keyword%");
            })
            ->get();

        foreach ($produits as $produit):
            ?>
            <?= $produit->nom ?> <?= substr($produit->description, 0, 50) ?><?php if (strlen($produit->description) > 50):?>...<?php endif?> <?= $produit->prix ?><br>
            <?php
        endforeach;

        echo '<br>';

        exit();

    }

    public function search(Request $request)
    {
        // recherche par fourchette de prix
        // et recherche par mot clé dans le nom ou la description

        // valeurs par défaut
        $keywords = '';
        $lowerLimit = 0.0;
        $upperLimit = 999.0;

        // on vérifie si l'utilisateur en envoyé des données ou pas
        if ($request->all()) {
            // l'utilisateur a validé le formulaire

            // sauvegarde des données du formulaire pour pouvoir les
            // afficher dans le template avec la fonction old()
            $request->flash();

            // validation des données du formulaire
            $validated = $request->validate([
                'keywords' => 'string|max:100|nullable',
                'lower_limit' => 'numeric|min:0|max:999|nullable',
                'upper_limit' => 'numeric|min:1|max:999|nullable',
            ]);

            // on remplace les valeurs par défaut seulement si
            // le champ a été renseigné dans la formulaire
            if ($request->filled('keywords')) {
                $keywords = $validated['keywords'];
            }

            if ($request->filled('lower_limit')) {
                $lowerLimit = $validated['lower_limit'];
            }

            if ($request->filled('upper_limit')) {
                $upperLimit = $validated['upper_limit'];
            }
        }

        // la requête de recherche de produits
        $produits = Produit::where('prix', '>=', $lowerLimit)
            ->where('prix', '<=', $upperLimit)
            ->where(function ($query) use ($keywords) {
                $query->where('nom', 'like', "%$keywords%")
                ->orWhere('description', 'like', "%$keywords%");
            })
            ->get();

        // le titre de la page
        $title = "search: keywords $keywords, lower limit $lowerLimit, upper limit $upperLimit";

        // afichage de la vue
        return view('main.search', [
            'title' => $title,
            'produits' => $produits,
        ]);
    }
}
