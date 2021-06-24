<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors :errors="$errors" />

        <!-- component -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>

        <div class="container max-w-full mx-auto md:py-24 px-6">
            <div class="max-w-sm mx-auto px-6">
                <div class="relative flex flex-wrap">
                    <div class="w-full relative">
                        <div class="md:mt-6">
                            <div class="text-center font-semibold text-black">
                                Załóż nowe konto rodzinki
                            </div>
                            <div class="text-center font-base text-black">
                                aby móc dodawać swoje bombelki i ich cytaty!
                            </div>
                            <form method="POST" action="{{ route('accounts.store') }}" class="mt-8" enctype="multipart/form-data">
                                <div class="mx-auto max-w-lg ">
                                    <div class="py-1">
                                        <span class="px-1 text-sm text-gray-600">Nazwa rodzinki</span>
                                        <input id="name" name="name" placeholder="" type="text" value="{{old('name')}}" required
                                               class="text-md block px-3 py-2 rounded-lg w-full
                                                bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"/>
                                    </div>

                                    <div class="py-1">
                                        <span class="px-1 text-sm text-gray-600">Bio: (opcjonalne)</span>
                                        <textarea id="bio" name="bio" rows="6" class="text-md block px-3 py-2 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-600
                                         shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"></textarea>
                                    </div>
                                    <div class="flex justify-start mt-3 ml-4 p-1">
                                        <ul>


                                        </ul>
                                    </div>
                                    <span class="px-1 text-sm text-gray-600">Awatar rodzinki</span>
                                    <div class="flex justify-start">
                                        <div class="border border-dashed border-gray-500 relative">
                                            <input id="avatar" name="avatar" type="file" value="{{old('avatar')}}"
                                                   class="cursor-pointer relative block opacity-0 w-full h-full p-20 z-50">
                                            <div class="text-center p-10 absolute top-0 right-0 left-0 m-auto">
                                                <h4>
                                                    Upuść zdjęcie tutaj
                                                    <br/>lub
                                                </h4>
                                                <p class="">wybierz z dysku</p>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="mt-3 text-lg font-semibold
                                        bg-gray-800 w-full text-white rounded-lg
                                        px-6 py-3 block shadow-xl hover:text-white hover:bg-black">
                                        {{ __('Utwórz konto') }}
                                    </button>
                                </div>
                            </form>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-auth-card>
</x-guest-layout>
