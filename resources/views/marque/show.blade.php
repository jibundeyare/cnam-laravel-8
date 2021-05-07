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

        <div>
            <input type="text" id="marque_id" value="{{ $marque->marque_id }}" disabled>
        </div>
        <div>
            <input type="text" name="nom" id="nom" value="{{ $marque->nom }}" readonly>
            </div>
        <div>
            <textarea name="description" id="description" cols="30" rows="10" readonly>{{ $marque->description }}</textarea>
        </div>
        <div>
            <input type="datetime" name="created_at" id="created_at" value="{{ $marque->created_at }}" readonly>
        </div>
        <div>
            <input type="datetime" name="updated_at" id="updated_at" value="{{ $marque->updated_at }}" readonly>
        </div>

        <div>
            <ul>
                <li>
                    <a href="{{ route('marques.edit', ['marque' => $marque->marque_id]) }}" class="btn btn-primary">modifier</a>
                </li>
                <li>
                    <form action="{{ route('marques.destroy', ['marque' => $marque->marque_id]) }}" method="post">
                        {{-- protection obligatoire contre les attaques CSRF --}}
                        @csrf

                        {{-- il faut spécifier la méthode DELETE car la route marques.destroy
                        n'est requêtable qu'avec cette méthode --}}
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">supprimer</button>
                    </form>
                </li>
            </ul>
        </div>

    </div>

@endsection
