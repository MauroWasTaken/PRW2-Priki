@extends('layout')
@section('content')
    <h1 class="text-3xl text-center font-bold text-blue-500 mb-3">References <a href="references/create" <span class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">+</span></a></h1>
    @foreach ($references as $reference)
        <div
            class="transform shadow-xl transition cursor-pointer  relative flex  px-6 py-4 bg-gray-100 text-black rounded mb-3 flex-col md:flex-col space-y-4 md:space-y-0">
            <!-- Content that showing in the box -->
            <div class="flex-auto">
                <a href="references/{{ $reference->id}}"><h1 class="text-xl font-bold rounded">{{ $reference->description }}</h1></a>
                @if(!empty($reference->url))
                <a href="{{ $reference->url }}">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">
                        Consulter
                    </button>
                </a>
                @endif
            </div>
        </div>
        <p><br></p>
    @endforeach
@endsection
