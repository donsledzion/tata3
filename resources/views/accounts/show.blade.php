
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('kidbook.account.preview') }}
        </h2>
    </x-slot>

    <!-- component -->

    <div class="mx-auto px-4 py-8 max-w-xl my-20">
        <div class="bg-white shadow-2xl rounded-lg mb-6 tracking-wide" >
            <div class="md:flex-shrink-0">
                @if($account->avatar == null)
                    <img src="{{ asset('storage/defaults/family_avatar.jpg') }}" alt="avatar" class="w-full h-auto rounded-lg rounded-b-none">
                @else
                <img src="{{ asset('storage/'.$account->id.'/768/' . $account->avatar) }}" alt="avatar" class="w-full h-auto rounded-lg rounded-b-none">
                @endif
            </div>
            <div class="px-4 py-2 mt-2">
                <h2 class="font-bold text-2xl text-gray-800 tracking-normal">{{$account->name}}</h2>
                <p class="text-sm text-gray-700 px-2 mr-1">
                    @if($account->bio)
                        {!! nl2br(e($account->bio)) !!}
                    @else
                    Tutaj w sumie przydałoby się krótkie, nieobligatoryjne bio o rodzince, ale zobaczymy jeszcze czy się coś takiego znajdzie :)
                    @endif
                </p>
                @if ((Illuminate\Support\Facades\Auth::user())->isParentToAccount()==$account->id)
                <a href="{{ route('accounts.edit',$account->id) }}"     class="bg-blue-500 p-2 text-white hover:shadow-lg text-xs font-thin">{{__('kidbook.button.edit')}}</a>
                <button class="bg-red-500 p-2 delete text-white hover:shadow-lg text-xs font-thin"
                        data-class="accounts"
                        data-id="{{ $account->id }}"
                        data-prompt="{{__('kidbook.prompt.question.delete.account')}}"
                >{{__('kidbook.button.delete')}}</button>
                @endif
                <div class="flex items-center justify-between mt-2 mx-6">
                </div>
                <div class="flex p-4 border-t border-gray-300 text-gray-700">
                    <div class="flex-1 inline-flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <p><span class="text-gray-900 font-bold">{{$account->kids->count()}}</span> {{__('kidbook.kid.kids')}}</p>
                    </div>
                    <div class="flex-1 inline-flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <p><span class="text-gray-900 font-bold">{{App\Models\Account::find($account->id)->users->count()}}</span> {{__('kidbook.misc.followers')}}</p>
                    </div>

                </div>
                <h2 class="font-bold text-2xl text-gray-800 tracking-normal">{{__('kidbook.kid.kids')}}</h2>
                <div class="content-center items-center">
                    @if ((Illuminate\Support\Facades\Auth::user())->isParentToAccount()==$account->id)
                        <a class="content-center items-center" href="{{route('kids.create')}}">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded items-center">
                                {{ __('kidbook.button.new_kid') }}
                            </button>
                        </a>
                    @endif
                        <div class="content-center h-4" ></div>
                </div>

                @foreach($account->kids as $kid)
                    <div class="bg-white shadow-xl rounded-lg overflow-hidden">
                        <div class="bg-cover bg-center h-96 p-4" style="background-image: url({{ asset('storage/'.$kid->account_id.'/768/' . $kid->avatar) }})">
                            <div class="flex justify-end">
                                <svg class="h-6 w-6 text-white fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path d="M12.76 3.76a6 6 0 0 1 8.48 8.48l-8.53 8.54a1 1 0 0 1-1.42 0l-8.53-8.54a6 6 0 0 1 8.48-8.48l.76.75.76-.75zm7.07 7.07a4 4 0 1 0-5.66-5.66l-1.46 1.47a1 1 0 0 1-1.42 0L9.83 5.17a4 4 0 1 0-5.66 5.66L12 18.66l7.83-7.83z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="p-4">
                            @if(Illuminate\Support\Facades\Auth::user()->isParentToAccount()==$account->id)
                            <a href="{{ route('kids.edit',$kid->id) }}"     class="bg-blue-500 p-2 text-white hover:shadow-lg text-xs font-thin">{{__('kidbook.button.edit')}}</a>
                            <button class="bg-red-500 p-2 delete text-white hover:shadow-lg text-xs font-thin"
                                    data-id="{{ $kid->id }}"
                                    data-class="kids"
                                    data-prompt="{{__('kidbook.prompt.question.delete.kid')}}"
                            >{{__('kidbook.button.delete')}}</button>
                            @endif
                            <p class="uppercase tracking-wide text-sm font-bold text-gray-700">{{$kid->first_name}}  {{$kid->last_name}}</p>
                            <p class="text-3xl text-gray-900">{{$kid->dim_name}}</p>
                            <p class="text-gray-700">{{__('kidbook.kid.bio')}} {!! nl2br(e($kid->about)) !!}</p>
                            <div class="flex p-4 border-t border-gray-300"></div>
                            <p class="text-gray-700">{{__('kidbook.kid.birth_date')}} {{$kid->birth_date}}</p>
                        </div>
                        <div class="flex p-4 border-t border-gray-300 text-gray-700">
                            <div class="flex-1 inline-flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 13V5a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h3l3 3 3-3h3a2 2 0 002-2zM5 7a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm1 3a1 1 0 100 2h3a1 1 0 100-2H6z" clip-rule="evenodd" />
                                </svg>
                                <p><span class="text-gray-900 font-bold">{{$kid->posts->count()}}</span> {{__('kidbook.post.posts')}}</p>
                            </div>
                            <div class="flex-1 inline-flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <p><span class="text-gray-900 font-bold">{{App\Models\Account::find($kid->account_id)->users->count()}}</span> {{__('kidbook.misc.followers')}}</p>
                            </div>
                        </div>
                        <div class="flex p-4 border-t border-gray-700 text-gray-700"></div>
                    </div>
                @endforeach

            </div>

        </div>

    </div>
    @section('javascript')
        const deleteUrl = "{{ url('') }}/" ;
        const confirmDelete = "{{ __('kidbook.messages.delete_confirm') }}" ;
        const contents = "{{ __('kidbook.messages.delete_account_contents') }}";
        const yesResponse = "{{ __('kidbook.messages.yes_response') }}";
        const noResponse = "{{ __('kidbook.messages.no_response') }}";
    @endsection

    @section('js-files')
        <script src="{{ asset('js/delete.js') }}" ></script>
    @endsection
</x-app-layout>

