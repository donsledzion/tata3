@if(!$im_invited->isEmpty())
    <div>
    <!-- When there is no desire, all things are at peace. - Laozi -->
        <div>
            <h2 class="text-2xl font-semibold leading-tight my-5">{{__('kidbook.relation.im_invited')}}</h2>
        </div>

        @foreach($im_invited as $inviting)
            <div class="max-w-3xl w-full mx-auto z-10">
                <div class="flex flex-col">
                    <div class="bg-white border border-white shadow-lg  rounded-3xl p-4 m-4">
                        <div class="flex-none sm:flex">
                            <div class=" relative w-32 sm:mb-0 mb-3">
                                <img class="h-auto rounded-full"
                                     @if(!empty($inviting->account->avatar))
                                     src="{{ asset('storage/'.$inviting->account->id.'/160/' . $inviting->account->avatar) }}"
                                     @else
                                     src="{{ asset('storage/defaults/family_avatar.jpg') }}"
                                     @endif
                                     alt="avatar" />

                            </div>
                            <div class="flex-auto sm:ml-5 justify-evenly">
                                <div class="flex items-center justify-between sm:mt-2">
                                    <div class="flex items-center">
                                        <div class="flex flex-col">
                                            <div class="w-full flex-none text-lg text-gray-800 font-bold leading-none">{{$inviting->account->name}}</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex pt-2  text-sm text-gray-500">
                                    <div class="flex-1 inline-flex items-center">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                            </path>
                                        </svg>
                                        <p class="whitespace-nowrap">{{$inviting->account->posts->count()}} {{__('kidbook.post.posts')}}</p>
                                    </div>
                                    <div class="flex-1 inline-flex items-center px-2">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                            </path>
                                        </svg>
                                        <p class="whitespace-nowrap">{{$inviting->account->kids->count()}} {{__('kidbook.kid.kids')}}</p>
                                    </div>
                                </div>


                                <div class="flex pt-2  text-sm text-gray-500">
                                    <div class="flex-1 items-center px-2">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                            </path>
                                        </svg>
                                        <p class="">{{__('kidbook.misc.message')}} {{$inviting->message}} </p>
                                    </div>
                                </div>



                                <div class="flex pt-2  text-sm text-gray-500">
                                    <button  data-id="{{$inviting->id}}" data-class="invitations" data-action="POST" class="accept-deny flex-no-shrink bg-green-400 hover:bg-green-500 px-5 ml-4 py-2 text-xs shadow-sm hover:shadow-lg font-medium tracking-wider border-2 border-green-300 hover:border-green-500 text-white rounded-full transition ease-in duration-300">
                                        {{__('kidbook.button.accept')}}
                                    </button>
                                    <button data-id="{{$inviting->id}}" data-class="invitations" data-action="DELETE" class="accept-deny flex-no-shrink bg-red-500 hover:bg-red-600 px-5 ml-4 py-2 text-xs shadow-sm hover:shadow-lg font-medium tracking-wider border-2 border-red-400 hover:border-red-600 text-white rounded-full transition ease-in duration-300">
                                        {{__('kidbook.button.deny')}}
                                    </button>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
