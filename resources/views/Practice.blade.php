@extends('layout')
@section('content')
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <style>
        .accordion-content {
            transition: max-height 0.3s ease-out, padding 0.3s ease;
        }

    </style>
    <h1 class="text-3xl text-center font-bold text-blue-500 mb-3">{{ $practice->name }}</h1>
    @if (Auth::User())
        @if (Auth::User()->can('update', $practice))
            <div class="flex w-full">
                <div>
                    <div @click="dropdownOpen = !dropdownOpen"
                        class="accordion-header cursor-pointer transition flex space-x-5">
                        <h2 class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                            Modifier le Titre</h2>
                    </div>
                    <form method="POST" action="/practice/{{ $practice->id }}/update">
                        {{ csrf_field() }}
                        <div x-show="dropdownOpen" class="right-0 bg-white rounded-md shadow-lg overflow-hidden z-20 my-2"
                            style="width:100%;">
                            <label class="mt-2 block text-gray-700 text-sm font-bold mb-2" for="title">
                                Nouveau Titre
                            </label>
                            <input
                                class="mb-3 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="title" name="title" maxlength="40" minlength="3" type="text"
                                value="{{ $practice->name }}" required>
                            <label class="mt-2 block text-gray-700 text-sm font-bold mb-2" for="reason">
                                Raison du changement
                            </label>
                            <input
                                class="mb-3 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="reason" name="reason" maxlength="40" minlength="3" type="text">
                            <input type="submit" value="enregistrer">
                        </div>
                    </form>
                </div>
            </div>
        @endif
    @endif
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
    @if ($practice->changelogs->count() > 0)
        <h2 class="text-2xl font-bold text-blue-500 mb-3">Historique de modifications</h2>
        @foreach ($practice->changelogs as $changelog)
            <div
                class="transform shadow-xl transition cursor-pointer  relative flex items-center px-6 py-4 bg-gray-100 text-black rounded mb-3 flex-col md:flex-row space-y-4 md:space-y-0">
                <div class="flex-auto">
                    <h1 class="text-xl font-bold rounded">{{ $changelog->user->name }}</h1>
                    <h1 class="text-xl font-bold rounded">{{ $changelog->updated_at->isoFormat('LL') }}</h1>
                    <h1 class="text-lg">{{ $changelog->reason }}</h1>
                    <h3>{{ $changelog->previously }}</h3>
                </div>
            </div>
            <p><br></p>
        @endforeach
    @endif
@endsection
