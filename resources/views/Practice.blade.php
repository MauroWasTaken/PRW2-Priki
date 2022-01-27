@extends('layout')
@section('content')
    <h1 class="text-3xl text-center font-bold text-blue-500 mb-3">{{ $practice->id }}</h1>
    <h2 class="text-2xl font-bold text-blue-500 mb-3">Domaine</h2>
    {{ $practice->domain->name }}
    <h2 class="text-2xl font-bold text-blue-500 mb-3">Description Complete</h2>
    {{ $practice->description }}
    <h2 class="text-2xl font-bold text-blue-500 mb-3">Auteur</h2>
    {{ $practice->user->fullname }}
    <h2 class="text-2xl font-bold text-blue-500 mb-3">Date de creation</h2>
    {{ $practice->created_at->isoFormat('LL') }}
    <h2 class="text-2xl font-bold text-blue-500 mb-3">Date de modification</h2>
    {{ $practice->updated_at->isoFormat('LL') }}
    <div class="mt-3">
        <a href="/practice/{{ $practice->id }}/opinions">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Opinions
            </button>
        </a>
        @if (Auth::User())
            @if ($practice->userHasOpinion(Auth::User()) && $practice->publicationState->slug == 'PRO')
                <a href="/practice/{{ $practice->id }}/publish">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        publier
                    </button>
                </a>
            @endif
        @endif
    </div>
@endsection
