@extends('app')

@section('title', $name)

@section('style')
    @parent
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')
    <!--
    enlever la balise parent et à redéfinir
    -->
    @parent
@endsection
