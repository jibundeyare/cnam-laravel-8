@extends('app')

@section('title', $title)

@section('style')
    @parent
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')

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
        @csrf
        <div>
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
    @foreach ($produits as $produit)
        <tr>
            <td>{{ $produit->nom }}</td>
            <td>{{ $produit->description }}</td>
            <td>{{ $produit->prix }}</td>
        </tr>
    @endforeach
    </table>

@endsection
