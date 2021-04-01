<?php

namespace App\Http\Controllers;

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
        $sql = 'SELECT marque.marque_id, marque.nom AS marque_nom, produit.produit_id, produit.nom AS produit_nom
        FROM marque
        INNER JOIN produit ON produit.marque_id = marque.marque_id';
        $rows = DB::select($sql);

        // echo '<pre>';
        // var_dump($marques);
        // echo '</pre>';

        $marque_id_precedent = 0;

        foreach ($rows as $row) {
            ?>
            <p>
                <?php if ($row->marque_id != $marque_id_precedent): ?>
                <h2><?= $row->marque_id ?> <?= $row->marque_nom ?></h2>
                <?php endif ?>
                - <?= $row->produit_id ?> <?= $row->produit_nom ?>
            </p>
            <?php
            $marque_id_precedent = $row->marque_id;
        }
        exit();
    }
}
