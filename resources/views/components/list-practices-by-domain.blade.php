<div>
    @foreach ($domains as $domain)
        @if ($mod == true)
            @php($domainPractices = $domain->practicesSortedByStatus)
        @else
            @php($domainPractices = $domain->publishedPractices())
        @endif
        @if ($domainPractices->count() > 0 && $domains->count() > 1)
            <h1 class="text-2xl text-center font-bold text-blue-500 mb-3">{{ $domain->name }}</h1>
        @endif
        @foreach ($domainPractices as $practice)
            <a href="/practice/{{ $practice->id }}">
                <div
                    class="transform shadow-xl transition cursor-pointer hover:-translate-y-2 relative flex items-center px-6 py-4 bg-gray-100 text-black rounded mb-3 flex-col md:flex-row space-y-4 md:space-y-0">
                    <!-- Content that showing in the box -->
                    <div class="flex-auto">
                        <h1 class="text-xl font-bold rounded">{{ $practice->name }}</h1>
                        @if ($mod == true)
                            <h1 class="text-xl font-bold rounded">{{ $practice->publicationState->name }}</h1>
                        @endif
                        <h1 class="text-lg">{{ $practice->updated_at->isoFormat('LL') }}</h1>
                        <h3 class="text-lg">{{ $practice->description }}</h1>
                    </div>
                </div>
            </a>
        @endforeach
        <p><br></p>
    @endforeach
</div>
