@extends('layout')
@section('content')
    <h1 class="text-3xl text-center font-bold text-blue-500 mb-3">Domains</h1>
    @foreach ($domains as $domain)
    @if ($domain->publishedPractices()->count()>0)
        <h1 class="text-2xl text-center font-bold text-blue-500 mb-3">{{ $domain->name }}</h1>
    @endif
        @foreach ($domain->publishedPractices() as $practice)
            <div
                class="transform shadow-xl transition cursor-pointer hover:-translate-y-2 relative flex items-center px-6 py-4 bg-gray-100 text-black rounded mb-3 flex-col md:flex-row space-y-4 md:space-y-0">
                <!-- Content that showing in the box -->
                <div class="flex-auto">
                    <h3 class="text-lg">{{ $practice->description }}</h1>
                </div>
            </div>
        @endforeach
        <p><br></p>
    @endforeach

@endsection
