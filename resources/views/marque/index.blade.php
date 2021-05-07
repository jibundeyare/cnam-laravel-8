@extends('app')

@section('title', $title)

@section('content')

    <div class="container">

        {{-- On affiche les messages flash s'il y a lieu --}}
        @if(Session::has('warning'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ Session::get('warning') }}
            </div>
        @endif

        {{-- On affiche les messages flash s'il y a lieu --}}
        @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('success') }}
            </div>
        @endif

        <div>
            <ul>
                <li>
                    <a href="{{ route('marques.create') }}" class="btn btn-primary">Créer une nouvelle marque</a>
                </li>
            </ul>
        </div>

        <div class="table-responsive">
            <table class="table table-dark table-striped table-hover table-bordered">
                <tr>
                    <th>id</th>
                    <th>nom</th>
                    <th>description</th>
                    <th>date de création</th>
                    <th>date de modification</th>
                    <th>actions</th>
                </tr>
                @foreach ($marques as $marque)
                    <tr>
                        <td>{{ $marque->marque_id }}</td>
                        <td>
                            <a href="{{ route('marques.show', ['marque' => $marque->marque_id]) }}" >{{ $marque->nom }}</a>
                        </td>
                        {{-- on tronque la description à partir 80 caractères et on affiche trois petits points '...'
                        Mais si la description est plus courte que 80 caractères, les trois petits poin,ts ne sont pas affichés --}}
                        <td>{{ Str::limit($marque->description, 80, '...') }}</td>
                        <td>{{ $marque->created_at }}</td>
                        <td>{{ $marque->updated_at }}</td>
                        <td>
                            <a href="{{ route('marques.show', ['marque' => $marque->marque_id]) }}" class="btn btn-primary">voir</a>
                            <a href="{{ route('marques.edit', ['marque' => $marque->marque_id]) }}" class="btn btn-primary">modifier</a>
                            <form action="{{ route('marques.destroy', ['marque' => $marque->marque_id]) }}" method="post">
                                {{-- protection obligatoire contre les attaques CSRF --}}
                                @csrf

                                {{-- il faut spécifier la méthode DELETE car la route marques.destroy
                                n'est requêtable qu'avec cette méthode --}}
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

    </div>

@endsection
