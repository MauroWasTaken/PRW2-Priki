<div>
    <div class="block text-gray-500 font-bold mb-5  pr-4">Afficher des Practices de <input wire:model="numberOfDays"
            class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="numberOfDays" type="number">
        Jours
    </div>
    @if (count($practices) == 0)
        <div class="flex gap-4 bg-red-100 p-4 rounded-md">
            <div class="space-y-1 text-sm">
                <h6 class="font-medium text-red-900">OOOPS</h6>
                <p class="text-red-700 leading-tight">Aucune Practice correspond aux critères</p>
            </div>
        </div>
    @else
        @foreach ($practices as $practice)
            <a href="/practice/{{ $practice->id }}">
                <div
                    class="transform shadow-xl transition cursor-pointer  relative flex items-center px-6 py-4 bg-gray-100 text-black rounded mb-3 flex-col md:flex-row space-y-4 md:space-y-0">
                    <!-- Content that showing in the box -->
                    <div class="flex-auto">
                        <h1 class="text-xl font-bold rounded">{{ $practice->name }}</h1>
                        <h1 class="text-xl font-bold rounded">{{ $practice->domain->name }}</h1>
                        <h1 class="text-lg">{{ $practice->updated_at->isoFormat('LL') }}</h1>
                        <h3>{{ $practice->description }}</h3>
                    </div>
                </div>
            </a>
            <p><br></p>
        @endforeach
    @endif
</div>
