@extends('app')

@section('title', $title)

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

        <form action="{{ route('marques.update', ['marque' => $marque->marque_id]) }}" method="post">
            @csrf
            <input name="_method" type="hidden" value="PUT">

            <div>
                <input type="text" id="marque_id" value="{{ $marque->marque_id }}">
            </div>
            <div>
                <input type="text" name="nom" id="nom" value="{{ $marque->nom }}">
                </div>
            <div>
                <textarea name="description" id="description" cols="30" rows="10">{{ $marque->description }}</textarea>
            </div>
            <div>
                <input type="datetime" name="created_at" id="created_at" value="{{ $marque->created_at }}">
            </div>
            <div>
                <input type="datetime" name="updated_at" id="updated_at" value="{{ $marque->updated_at }}">
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
