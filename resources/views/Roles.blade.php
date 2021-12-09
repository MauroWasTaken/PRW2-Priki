@extends('layout')
@section('content')
<h1>Domains</h1>
@foreach (\App\Models\Role::all() as $role)
<p>{{$role->name}}</p>
@endforeach
@endsection
