@extends('layout')
@section('content')
    <h1 class="text-xl font-bold rounded">Role: {{ Auth::User()->role->name }}</h1>
    <x-list-practices-by-domain :domains=$domains/>
@endsection
