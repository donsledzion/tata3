<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img src="../../storage/components/logo_tata.png" class="w-36 h-36 fill-current text-gray-500" />
            </a>
        </x-slot>
        <x-slot name="title">
            {{__('Edit family')}}
        </x-slot>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('accounts.update', $account) }}" enctype="multipart/form-data">
            @csrf

            <!-- Account name -->
            <div>
                <x-label for="name" :value="__('Family name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{$account->name}}" required autofocus />
            </div>

            <div class="py-1">
                <span class="px-1 text-sm text-gray-600">{{__('Bio')}}: {{__('(optional)')}}</span>
                <textarea id="bio" name="bio" rows="6" class="text-md block px-3 py-2 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-600
                                     shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">{{$account->bio, old('bio')}}</textarea>
            </div>

            <!-- Account avatar -->
            <div class="mt-4">
                <div class="content-evenly border border-dashed border-gray-500"><img src="{{asset('storage/'.$account->id.'/480/'.$account->avatar)}}" /></div>
                <div class="flex justify-start">

                    <div class="border border-dashed border-gray-500 relative">

                        <input id="avatar" name="avatar" type="file"
                               class="cursor-pointer relative block opacity-0 w-full h-full p-20 z-50" >
                        <div class="text-center p-10 absolute top-0 right-0 left-0 m-auto" >
                            <h4>
                                {{__('Drop picture here')}}
                                <br/>{{__('or')}}
                            </h4>
                            <p class="">{{__('select from device')}}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">

                <x-button class="ml-4">
                    {{ __('Save edition') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
