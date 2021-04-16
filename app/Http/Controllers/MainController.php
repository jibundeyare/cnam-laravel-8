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
        $formData = [
            'keywords' => '',
            'lower_limit' => 0.0,
            'upper_limit' => 999.0,
        ];

        // on vérifie si l'utilisateur en envoyé des données ou pas
        // $request->all() renvoit l'équivalent de la variable $_POST
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
                $formData['keywords'] = $validated['keywords'];
            }

            if ($request->filled('lower_limit')) {
                $formData['lower_limit'] = $validated['lower_limit'];
            }

            if ($request->filled('upper_limit')) {
                $formData['upper_limit'] = $validated['upper_limit'];
            }
        }

        // création de la requête de recherche de produits
        $builder = Produit::select();

        $builder->where('prix', '>=', $formData['lower_limit']);
        $builder->where('prix', '<=', $formData['upper_limit']);

        // on transforme la chaîne de caractère en tableau de mots
        // en se servant de l'espace ' ' comme séparateur
        $keywords = explode(' ', $formData['keywords']);

        foreach ($keywords as $keyword) {
            $builder->where(function ($query) use ($keyword) {
                $query->where('nom', 'like', "%$keyword%")
                ->orWhere('description', 'like', "%$keyword%");
            });
        }

        // le foreach ci-dessus construit des conditions comme ci-dessous :
        // (nom LIKE 'foo' OR description LIKE 'foo')
        // AND (nom LIKE 'bar' OR description LIKE 'bar')
        // AND (nom LIKE 'baz' OR description LIKE 'baz')
        // ...

        // exécution de la requête
        $produits = $builder->get();

        // le titre de la page
        $title = "search: keywords {$formData['keywords']}, lower limit {$formData['lower_limit']}, upper limit {$formData['upper_limit']}";

        // afichage de la vue
        return view('main.search', [
            'title' => $title,
            'produits' => $produits,
        ]);
    }
}
