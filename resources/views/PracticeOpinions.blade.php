@extends('layout')
@section('content')
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <style>
        .accordion-content {
            transition: max-height 0.3s ease-out, padding 0.3s ease;
        }

    </style>
    <h2 class="text-2xl font-bold text-blue-500 mb-3">{{ $practice->description }}</h2>
    <h3 class="mb-8">Par: {{ $practice->user->fullname }}</h3>
    @foreach ($practice->opinions as $opinion)
        <div x-data="{ dropdownOpen: true }"
            class="transform shadow-xl transition cursor-pointer  relative flex  px-6 py-4 bg-gray-100 text-black rounded mb-3 flex-col md:flex-col space-y-4 md:space-y-0">
            <!-- Content that showing in the box -->
            <div class="flex-auto">
                <h1 @click="dropdownOpen = false" class="text-xl font-bold rounded">{{ $opinion->description }}</h1>
                <h1 @click="dropdownOpen = false" class="text-lg">Author: {{ $opinion->user->fullname }}</h1>
                <h3 @click="dropdownOpen = false">Creation Date: {{ $opinion->created_at->isoFormat('LL') }}</h3>
                <h3 @click="dropdownOpen = false" class="mt-2 mb-2">{{ $opinion->created_at->isoFormat('LL') }}</h3>
                <h2 @click="dropdownOpen = false">References</h2>
                @if ($opinion->comments->isNotEmpty())
                    <em class="far fa-comments"></em>
                    <span class="has-text-success">
                        {{ $opinion->upVotes() }} - <svg xmlns="http://www.w3.org/2000/svg" class="inline-block h-5 w-5"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg>
                    </span>
                    <span class="has-text-danger ">
                        {{ $opinion->downVotes() }} - <svg xmlns="http://www.w3.org/2000/svg" class="inline-block h-5 w-5"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                        </svg>
                    </span>
                @else
                    0 <em class="far fa-comments"></em>
                @endif
                @foreach ($opinion->references as $reference)
                    <h4>
                        @if (!empty($reference->url))
                            <a class="underline text-blue-600 hover:text-blue-800 visited:text-purple-600 z-20"
                                href="{{ $reference->url }}" target="_blank">
                                {{ $reference->description }}
                            </a>
                        @else
                            {{ $reference->description }}
                        @endif
                    </h4>
                @endforeach
                <div class="flex w-full">
                    <div>
                        <div @click="dropdownOpen = !dropdownOpen"
                            class="accordion-header cursor-pointer transition flex space-x-5">
                            <h2 class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                                Commentaires</h2>
                        </div>
                        @foreach ($opinion->comments as $comment)
                            <div x-show="dropdownOpen"
                                class="right-0 bg-white rounded-md shadow-lg overflow-hidden z-20 my-2" style="width:100%;">
                                <a href="#" class="flex items-center px-4 py-3 border-b hover:bg-gray-100 mx-2">
                                    <p class="text-gray-600 text-sm ">
                                        <span class="font-bold" href="#">{{ $comment->fullname }} </span>
                                        {{ $comment->pivot->comment }}
                                    </p>
                                </a>
                            </div>
                        @endforeach
                        @if (Auth::User())
                            <form method="POST" action="/practice/{{ $practice->id }}/opinion/{{ $opinion->id }} ">
                                {{ csrf_field() }}
                                <div x-show="dropdownOpen"
                                    class="right-0 bg-white rounded-md shadow-lg overflow-hidden z-20 my-2"
                                    style="width:100%;">
                                    <label class="mt-2 block text-gray-700 text-sm font-bold mb-2" for="comment">
                                        Comment
                                    </label>
                                    <input
                                        class="mb-3 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="comment" name="comment" maxlength="1000" type="textarea" placeholder="comment">
                                    <div class="flex justify-center">
                                        <div class="form-check form-check-inline">
                                            <input
                                                class="form-check-input form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                                type="radio" name="voteRadioOptions" id="upVote" value="1">
                                            <label class="form-check-label inline-block text-gray-800"
                                                for="upvote">upvote</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input
                                                class="form-check-input form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                                type="radio" name="voteRadioOptions" id="downVote" value="-1">
                                            <label class="form-check-label inline-block text-gray-800"
                                                for="downvote">downvote</label>
                                        </div>
                                    </div>
                                    <input type="submit" value="enregistrer">
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <p><br></p>
    @endforeach
@endsection
