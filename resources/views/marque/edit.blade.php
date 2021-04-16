@extends('app')

@section('title', $title)

@section('content')

    <div class="container">

        <form action="{{ route('marques.update', ['marque' => $marque->marque_id]) }}" method="post">
            {{-- protection obligatoire contre les attaques CSRF --}}
            @csrf
            {{-- il faut spécifier la méthode PUT car la route marques.update
            n'est requêtable qu'avec cette méthode --}}
            @method('PUT')

            <div>
                <input type="text" id="marque_id" value="{{ $marque->marque_id }}">
            </div>
            <div>
                {{-- affichage d'un champ avec la valeur entrée par l'utilisateur.
                Ajout de la classe css is-invalid s'il y a une erreur --}}
                <input type="text" name="nom" id="nom" value="{{ $marque->nom }}" class="@error('nom') is-invalid @enderror">
                {{-- affichage des messages d'erreur du champ --}}
                @error('nom')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div>
                {{-- affichage d'un champ avec la valeur entrée par l'utilisateur.
                Ajout de la classe css is-invalid s'il y a une erreur --}}
                <textarea name="description" id="description" cols="30" rows="10" class="@error('description') is-invalid @enderror">{{ $marque->description }}</textarea>
                {{-- affichage des messages d'erreur du champ --}}
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div>
                {{-- affichage d'un champ avec la valeur entrée par l'utilisateur.
                Ajout de la classe css is-invalid s'il y a une erreur --}}
                <input type="datetime" name="created_at" id="created_at" value="{{ $marque->created_at }}" class="@error('created_at') is-invalid @enderror">
                {{-- affichage des messages d'erreur du champ --}}
                @error('created_at')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div>
                {{-- affichage d'un champ avec la valeur entrée par l'utilisateur.
                Ajout de la classe css is-invalid s'il y a une erreur --}}
                <input type="datetime" name="updated_at" id="updated_at" value="{{ $marque->updated_at }}" class="@error('updated_at') is-invalid @enderror">
                {{-- affichage des messages d'erreur du champ --}}
                @error('updated_at')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <button type="submit">valider</button>
            </div>
        </form>

        <div>
            <a href="{{ route('marques.show', ['marque' => $marque->marque_id]) }}" >voir</a>
        </div>

    </div>

@endsection
