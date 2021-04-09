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
            'name' => $name,
        ]);
    }

    public function test()
    {
        // méthode moderne avec l'orm eloquent
        // foreach (Marque::all() as $marque) {
        //     echo $marque->nom;
        //     echo '<br>';

        //     foreach ($marque->produits() as $produit) {
        //         echo $produit->nom;
        //         echo '<br>';
        //     }
        // }

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
    }

    public function search(Request $request)
    {
        // recherche par fourchette de prix
        // et recherche par mot clé dans le nom ou la description
        $lowerLimit = $request->input('lower_limit', 0.0);
        $upperLimit = $request->input('upper_limit', 0.0);
        $keyword = $request->input('nom', '');

        $produits = Produit::where('prix', '>=', $lowerLimit)
            ->where('prix', '<=', $upperLimit)
            ->where(function ($query) use ($keyword) {
                $query->where('nom', 'like', "%$keyword%")
                ->orWhere('description', 'like', "%$keyword%");
            })
            ->get();

        $title = "search: keyword $keyword, lower limit $lowerLimit, upper limit $upperLimit";

        return view('main.search', [
            'title' => $title,
            'produits' => $produits,
        ]);
    }
}
