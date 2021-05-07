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
        $title = 'marques';

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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

        // afichage de la vue
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
        // @todo valider les données et les enregistrer
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
