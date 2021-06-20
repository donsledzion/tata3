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

        <form method="POST" action="{{ route('accounts.update', $account) }}">
            @csrf

            <!-- Account name -->
            <div>
                <x-label for="name" :value="__('Nazwa rodzinki')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{$account->name}}" required autofocus />
            </div>

            <!-- Account avatar -->
            <div class="mt-4">
                <x-label for="avatar" :value="__('Wybierz avatar')" />

                <x-input id="avatar" class="block mt-1 w-full" type="file" name="avatar" value="{{$account->avatar}}"  />
            </div>

            <div class="flex items-center justify-end mt-4">


                <x-button class="ml-4">
                    {{ __('Zapisz edycję') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
