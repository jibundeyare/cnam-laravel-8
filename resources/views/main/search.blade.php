@extends('app')

@section('title', $title)

@section('style')
    @parent
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')

    <div class="container">

        {{-- affichage des messages d'erreur --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="post">
            {{-- protection obligatoire contre les attaques CSRF --}}
            @csrf
            <div>
                {{-- affichage d'un champ avec l'ancienne valeur entrée par l'utilisateur --}}
                <input type="text" name="keywords" id="keywords" value="{{ old('keywords') }}">
            </div>
            <div>
                <input type="number" name="lower_limit" id="lower_limit" value="{{ old('lower_limit') }}">
            </div>
            <div>
                <input type="number" name="upper_limit" id="upper_limit" value="{{ old('upper_limit') }}">
            </div>
            <div>
            <button type="submit">chercher</button>
            </div>
        </form>

        <table>
            <tr>
                <th>nom</td>
                <th>description</td>
                <th>prix</td>
                <th>marque</td>
            </tr>
            {{-- affichage du résultat de la requête --}}
            @foreach ($produits as $produit)
                <tr>
                    <td>{{ $produit->nom }}</td>
                    <td>{{ $produit->description }}</td>
                    <td>{{ $produit->prix }}</td>
                    {{-- une marque est un modèle (une classe) lié avec une relation « one to many » à un produit.
                    Quand on utilise un ORM, il n'est pas nécessaire de faire de jointure pour
                    avoir accès aux données reliées par une clé étrangère --}}
                    <td>{{ $produit->marque->nom }}</td>
                </tr>
            @endforeach
        </table>

    </div>

@endsection
