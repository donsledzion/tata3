<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('kidbook.kid.add_title') }}
        </h2>
    </x-slot>


        <!-- component -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>

        <div class="container max-w-full mx-auto md:py-24 px-6" style="background-image: url({{asset('storage/components/backgrounds/watercolor.png')}})" >
            {{--background image comes from subtlepatterns--}}

            <div class="max-w-sm mx-auto px-6">
                <div class="relative flex flex-wrap">
                    <div class="place-content-center font-semibold text-black">
                        <svg class="w-32 h-32 inline animate-pulse"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z">
                            </path>
                        </svg>

                    </div>
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <div class="w-full relative" style="background-color:white;">
                        <div class="md:mt-6">
                            <div class="text-center font-semibold text-black">
                                {{__('kidbook.kid.add_subtitle_1')}}
                            </div>
                            <div class="text-center font-base text-black">
                                {{__('kidbook.kid.add_subtitle_2')}}
                            </div>
                            <form method="POST" action="{{ route('kids.store') }}" class="mt-8" enctype="multipart/form-data">
                                <div class="mx-auto max-w-lg ">
                                    <div class="py-1">
                                        <span class="px-1 text-sm text-gray-600">{{__('kidbook.kid.select_gender')}}</span>
                                        <div class="flex">
                                            <div class="flex items-center mb-2 mr-2">
                                                <input type="radio" id="gender-female"  name="gender" class="h-4 w-4 text-gray-700 px-3 py-3 border rounded mr-3" value="2">
                                                <label for="gender-female" class="px-1 text-sm text-gray-600">{{__('genders.female')}}</label>
                                            </div>
                                            <div class="flex items-center mb-2  mr-2">
                                                <input type="radio" id="gender-male"    name="gender" class="h-4 w-4 text-gray-700 px-3 py-3 border rounded mr-3" value="1">
                                                <label for="gender-male" class="px-1 text-sm text-gray-600">{{__('genders.male')}}</label>
                                            </div>
                                            <div class="flex items-center mb-2">
                                                <input type="radio" id="gender-other" name="gender" class="h-4 w-4 text-gray-700 px-3 py-3 border rounded mr-3" value="3">
                                                <label for="gender-other" class="px-1 text-sm text-gray-600">{{__('genders.other')}}</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="py-1">
                                        <span class="px-1 text-sm text-gray-600">{{__('kidbook.kid.first_name')}}</span>
                                        <input id="first_name" name="first_name" placeholder="" type="text" value="{{old('first_name')}}" required
                                               class="text-md block px-3 py-2 rounded-lg w-full
                                                bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"/>
                                    </div>

                                    <div class="py-1">
                                        <span class="px-1 text-sm text-gray-600">{{__('kidbook.kid.last_name')}} {{__('kidbook.misc.optional')}}</span>
                                        <input id="last_name" name="last_name" placeholder="" type="text" value="{{old('last_name')}}"
                                               class="text-md block px-3 py-2 rounded-lg w-full
                                                bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"/>
                                    </div>

                                    <div class="py-1">
                                        <span class="px-1 text-sm text-gray-600">{{__('kidbook.kid.nickname')}}</span>
                                        <input id="dim_name" name="dim_name" placeholder="" type="text" value="{{old('dim_name')}}"
                                               class="text-md block px-3 py-2 rounded-lg w-full
                                                bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"/>
                                    </div>

                                    <div class="py-1">
                                        <span class="px-1 text-sm text-gray-600">{{__('kidbook.kid.bio')}} {{__('kidbook.misc.optional')}}</span>
                                        <textarea id="about" name="about" rows="6" class="text-md block px-3 py-2 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-600
                                         shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"></textarea>
                                    </div>
                                    <div class="flex justify-start mt-3 ml-4 p-1">
                                        <ul>


                                        </ul>
                                    </div>

                                    <div class="py-1">
                                        <span class="px-1 text-sm text-gray-600">{{__('kidbook.kid.birth_date')}}</span>
                                        <input id="birth_date" name="birth_date" placeholder="" type="date" value="{{old('birth_date')}}"
                                               class="text-md block px-3 py-2 rounded-lg w-full
                                                bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"/>
                                    </div>

                                    <span class="px-1 text-sm text-gray-600">{{__('kidbook.kid.picture')}} {{__('kidbook.misc.optional')}}</span>
                                    <div class="flex justify-start">
                                        <div class="border border-dashed border-gray-500 relative">
                                            <input id="avatar" name="avatar" type="file" value="{{old('avatar')}}"
                                                   class="cursor-pointer relative block opacity-0 w-full h-full p-20 z-50">
                                            <div class="text-center p-10 absolute top-0 right-0 left-0 m-auto">
                                                <h4>
                                                    {{__('kidbook.misc.picture_dropdown_1')}}
                                                    <br/>{{__('kidbook.misc.picture_dropdown_2')}}
                                                </h4>
                                                <p class="">{{__('kidbook.misc.picture_dropdown_3')}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="mt-3 text-lg font-semibold
                                        bg-gray-800 w-full text-white rounded-lg
                                        px-6 py-3 block shadow-xl hover:text-white hover:bg-black">
                                        {{ __('kidbook.button.new_kid') }}
                                        <svg class="w-8 h-8 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </form>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
