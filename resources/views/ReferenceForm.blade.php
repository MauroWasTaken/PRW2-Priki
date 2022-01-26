@extends('layout')
@section('content')
    <div class=" p-8 bg-gray-100">
        <form method="POST" action="{{ route('references.store') }}">
            @csrf
            <div>
                <x-label for="description" :value="__('Description')" />

                <x-input id="description" class="block mt-1 w-full" type="text" name="description"
                    :value="old('description')" required autofocus />
            </div>
            <div class="mt-4">
                <x-label for="url" value="Site Web" />
                <x-input id="url" class="block mt-1 w-full" type="url" name="url" required />
            </div>
            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-3">
                    Enregistrer
                </x-button>
            </div>
        </form>
    </div>
@endsection
