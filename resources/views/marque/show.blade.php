@extends('app')

@section('title', $title)

@section('content')

    <div class="container">

        <div>
            <input type="text" id="marque_id" value="{{ $marque->marque_id }}" readonly>
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
            <a href="{{ route('marques.edit', ['marque' => $marque->marque_id]) }}" >modifier</a>
        </div>

    </div>

@endsection
