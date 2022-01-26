@extends('layout')
@section('content')
    <h1 class="text-3xl text-center font-bold text-blue-500 mb-3">Domaines</h1>
    <x-list-practices-by-domain :mod=false :domains=$domains/>

@endsection
