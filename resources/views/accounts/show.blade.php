<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>
        <x-slot name="title">
            Edytuj konto
        </x-slot>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

            @csrf

            <!-- Account name -->
            <div>
                <x-label for="name" :value="__('Nazwa rodzinki')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{$account->name}}" required autofocus disabled />
            </div>

            <!-- Account avatar -->


            <div>
                <x-label for="kids" :value="__('Bombelki')" />
                @foreach($account->kids as $kid)
                    <x-input id="kid_{{$kid->id}}" class="block mt-1 w-full" type="text" name="dim_name" value="{{$kid->first_name}} &#34;{{$kid->dim_name}}&#34; {{$kid->last_name}} " required autofocus disabled />
                @endforeach

            </div>

    </x-auth-card>
</x-guest-layout>
