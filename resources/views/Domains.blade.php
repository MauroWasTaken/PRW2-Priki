@extends('layout')
@section('content')
    <h1>Domains</h1>
    @foreach ($domains as $domain)
        <p>{{ $domain->name }}
            @foreach ($domain->practices as $practice)
                <br>{{ $practice->description }}
            @endforeach
        </p>
    @endforeach
@endsection
