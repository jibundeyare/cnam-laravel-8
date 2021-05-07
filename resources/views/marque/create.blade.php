@extends('app')

@section('title', $title)

@section('content')

    <div class="container">

        <div>
            <ul>
                <li>
                    <a href="{{ route('marques.index') }}" class="btn btn-primary">voir la liste</a>
                </li>
            </ul>
        </div>

        <form action="{{ route('marques.store') }}" method="post">
            {{-- protection obligatoire contre les attaques CSRF --}}
            @csrf

            <div>
                {{-- affichage d'un champ avec la valeur entrée par l'utilisateur.
                Ajout de la classe css is-invalid s'il y a une erreur --}}
                <input type="text" name="nom" id="nom" value="" class="@error('nom') is-invalid @enderror">
                {{-- affichage des messages d'erreur du champ --}}
                @error('nom')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div>
                {{-- affichage d'un champ avec la valeur entrée par l'utilisateur.
                Ajout de la classe css is-invalid s'il y a une erreur --}}
                <textarea name="description" id="description" cols="30" rows="10" class="@error('description') is-invalid @enderror"></textarea>
                {{-- affichage des messages d'erreur du champ --}}
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div>
                {{-- affichage d'un champ avec la valeur entrée par l'utilisateur.
                Ajout de la classe css is-invalid s'il y a une erreur --}}
                <input type="datetime" name="created_at" id="created_at" value="" class="@error('created_at') is-invalid @enderror">
                {{-- affichage des messages d'erreur du champ --}}
                @error('created_at')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div>
                {{-- affichage d'un champ avec la valeur entrée par l'utilisateur.
                Ajout de la classe css is-invalid s'il y a une erreur --}}
                <input type="datetime" name="updated_at" id="updated_at" value="" class="@error('updated_at') is-invalid @enderror">
                {{-- affichage des messages d'erreur du champ --}}
                @error('updated_at')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <button type="submit" class="btn btn-success">valider</button>
            </div>
        </form>

    </div>

@endsection
