<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('kidbook.post.add_title') }}
        </h2>
    </x-slot>



        <!-- component -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>

        <div class="container max-w-full mx-auto md:py-24 px-6">

            <div class="max-w-sm mx-auto px-6">
                <div class="relative flex flex-wrap">
                    <div class="place-content-center font-semibold text-black">
                        <svg class="w-32 h-32" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                            </path>
                        </svg>

                    </div>

                    <div class="w-full relative">
                        <div class="md:mt-6">
                            <div class="text-center font-semibold text-black">
                                {{__('kidbook.post.add_subtitle')}}
                            </div>
                            <!-- Validation Errors -->
                            <x-auth-validation-errors :errors="$errors" />
                            <form method="POST" action="{{ route('posts.store') }}" class="mt-8" enctype="multipart/form-data">
                                <div class="mx-auto max-w-lg ">
                                    <input name="author_id" id="author_id" hidden value="{{Illuminate\Support\Facades\Auth::id()}}" />
                                    <span class="px-1 text-sm text-gray-600">{{_('kidbook.post.quoted_kid')}}</span>
                                    <select name="kid_id" id="kid_id" class="text-md block px-3 py-2 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">
                                        @foreach($kids as $kid)
                                        <option value="{{$kid->id}}">{{$kid->dim_name}}</option>
                                        @endforeach
                                    </select>

                                    <div class="py-1">
                                        <span class="px-1 text-sm text-gray-600">{{__('kidbook.post.post')}}</span>
                                        <textarea id="sentence" name="sentence" rows="6" class="text-md block px-3 py-2 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-600
                                         shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none" required></textarea>
                                    </div>

                                    <div class="flex justify-start mt-3 ml-4 p-1">
                                        <ul>

                                        </ul>
                                    </div>

                                    <span class="px-1 text-sm text-gray-600">{{__('kidbook.post.picture')}}</span>
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

                                    <div class="py-1">
                                        <span class="px-1 text-sm text-gray-600">{{__('kidbook.post.date')}}</span>
                                        <input id="said_at" name="said_at" type="date" value="{{ old('said_at', $said_at) }}"
                                               class="text-md block px-3 py-2 rounded-lg w-full
                                                bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"/>
                                    </div>

                                    <span class="px-1 text-sm text-gray-600">{{__('kidbook.post.visibility')}}</span>
                                    <select name="status_id" id="status_id" class="text-md block px-3 py-2 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">
                                        @foreach($statuses as $status)
                                            <option value="{{$status->id}}"
                                            @if($status->default==true)
                                            {{' selected '}}
                                            @endif
                                            >
                                                {{__($status->name)}}
                                            </option>
                                        @endforeach
                                    </select>

                                    <button class="mt-3 text-lg font-semibold
                                        bg-gray-800 w-full text-white rounded-lg
                                        px-6 py-3 block shadow-xl hover:text-white hover:bg-black">
                                        {{ __('kidbook.button.new_post') }}
                                        <svg class="w-8 h-8 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                                            </path>
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
