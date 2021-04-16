@extends('app')

@section('title', $title)

@section('style')
    @parent
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')

    <div class="container">

        <form method="post">
            {{-- protection obligatoire contre les attaques CSRF --}}
            @csrf

            <div>
                {{-- affichage d'un champ avec la valeur entrée par l'utilisateur.
                Ajout de la classe css is-invalid s'il y a une erreur --}}
                <input type="text" name="keywords" id="keywords" value="{{ old('keywords') }}" class="@error('keywords') is-invalid @enderror">
                {{-- affichage des messages d'erreur du champ --}}
                @error('keywords')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div>
                {{-- affichage d'un champ avec la valeur entrée par l'utilisateur.
                Ajout de la classe css is-invalid s'il y a une erreur --}}
                <input type="number" name="lower_limit" id="lower_limit" value="{{ old('lower_limit') }}" class="@error('lower_limit') is-invalid @enderror">
                {{-- affichage des messages d'erreur du champ --}}
                @error('lower_limit')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div>
                {{-- affichage d'un champ avec la valeur entrée par l'utilisateur.
                Ajout de la classe css is-invalid s'il y a une erreur --}}
                <input type="number" name="upper_limit" id="upper_limit" value="{{ old('upper_limit') }}" class="@error('upper_limit') is-invalid @enderror">
                {{-- affichage des messages d'erreur du champ --}}
                @error('upper_limit')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div>
            <button type="submit">chercher</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-dark table-striped table-hover table-bordered">
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

    </div>

@endsection
