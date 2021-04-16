@extends('app')

@section('title', $title)

@section('content')

    <div class="container">

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
                            <a href="{{ route('marques.show', ['marque' => $marque->marque_id]) }}" >voir</a>
                            <a href="{{ route('marques.edit', ['marque' => $marque->marque_id]) }}" >modifier</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

    </div>

@endsection
