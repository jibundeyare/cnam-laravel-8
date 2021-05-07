<?php

namespace App\Http\Controllers;

use App\Models\Marque;
use Illuminate\Http\Request;

class MarqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // création du titre
        $title = 'liste des marques';

        // recherche de toutes les marques
        $marques = Marque::all();

        // affichage de la vue
        return view('marque.index', [
            'title' => $title,
            'marques' => $marques,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // création du titre
        $title = "création d'une marque";

        // affichage de la vue
        return view('marque.create', [
            'title' => $title,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation des données envoyées par l'utilisateur
        $request->validate([
            'nom' => 'string|max:100|required',
            'description' => 'string|max:1000|nullable'
        ]);

        // création d'une nouvelle marque
        $marque = new Marque();
        // affectation des données de la marque
        $marque->nom = $request->nom;
        $marque->description = $request->description;

        // enregistrement des nouvelles données de la marque
        $marque->save();

        // redirection vers la page de la marque
        return redirect()->route('marques.show', ['marque' => $marque]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // recherche d'une marque à partir de l'id spécifié
        $marque = Marque::find($id);

        // création du titre à partir des données de la marque demandée
        $title = "marque : {$marque->nom} ($id)";

        // affichage de la vue
        return view('marque.show', [
            'title' => $title,
            'marque' => $marque,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // recherche d'une marque à partir de l'id spécifié
        $marque = Marque::find($id);

        // création du titre à partir des données de la marque demandée
        $title = "marque : {$marque->nom} ($id)";

        // affichage de la vue
        return view('marque.edit', [
            'title' => $title,
            'marque' => $marque,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // validation des données envoyées par l'utilisateur
        $request->validate([
            'nom' => 'string|max:100|required',
            'description' => 'string|max:1000|nullable'
        ]);

        // recherche d'une marque à partir de l'id spécifié
        $marque = Marque::find($id);
        // mise à jour des données de la marque
        $marque->nom = $request->nom;
        $marque->description = $request->description;

        // enregistrement des données de la marque
        $marque->save();

        // redirection vers la page de la marque
        return redirect()->route('marques.show', ['marque' => $marque]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // recherche d'une marque à partir de l'id spécifié
        $marque = Marque::find($id);

        // on vérifie si la marque est référencée par un produit
        if (count($marque->produits()->get()) > 0) {
            // la marque est référencée par des produits
            // on ne peut pas la supprimer
            $request->session()->flash('warning', 'Impossible de supprimer cette marque car elle est référencée par un produit');
        } else {
            // la marque n'est référencée par aucun produit
            // elle est supprimée
            $marque->delete();
            $request->session()->flash('success', 'Marque supprimée');
        }

        // redirection vers la liste des marques
        return redirect()->route('marques.index');
    }
}
