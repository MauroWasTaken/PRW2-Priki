@extends('layout')
@section('content')
    <h1>Roles</h1>
    {{ $filterValue }}
    @foreach (\App\Models\Practice::all() as $practice)
        <p>{{$practice->description}}<br>{{$practice->domain->name}}</p>
    @endforeach
@endsection
