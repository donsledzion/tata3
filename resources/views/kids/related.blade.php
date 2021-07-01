
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bombelki') }}
        </h2>
    </x-slot>

        <!-- component -->
        @foreach($kids as $kid)
        <div class="max-w-6xl mx-auto">
            <div class="flex items-center justify-center min-h-full">
                <div class="max-w-sm w-full sm:w-1/2 lg:w-1/3 py-6 px-3">
                    <div class="bg-white shadow-xl rounded-lg overflow-hidden">
                        <div class="bg-cover bg-center h-96 p-4" style="background-image: url({{ asset('storage/'.$kid->account_id.'/480/' . $kid->avatar) }})">
                            <div class="flex justify-end">
                                <svg class="h-6 w-6 text-white fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path d="M12.76 3.76a6 6 0 0 1 8.48 8.48l-8.53 8.54a1 1 0 0 1-1.42 0l-8.53-8.54a6 6 0 0 1 8.48-8.48l.76.75.76-.75zm7.07 7.07a4 4 0 1 0-5.66-5.66l-1.46 1.47a1 1 0 0 1-1.42 0L9.83 5.17a4 4 0 1 0-5.66 5.66L12 18.66l7.83-7.83z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="p-4">
                            <p class="uppercase tracking-wide text-sm font-bold text-gray-700">{{$kid->first_name}}  {{$kid->last_name}}</p>
                            <p class="text-3xl text-gray-900">{{$kid->dim_name}}</p>
                            <p class="text-gray-700">Narodziny: {{$kid->birth_date}}</p>
                        </div>
                        <div class="flex p-4 border-t border-gray-300 text-gray-700">
                            <div class="flex-1 inline-flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 13V5a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h3l3 3 3-3h3a2 2 0 002-2zM5 7a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm1 3a1 1 0 100 2h3a1 1 0 100-2H6z" clip-rule="evenodd" />
                                </svg>
                                <p><span class="text-gray-900 font-bold">{{$kid->posts->count()}}</span> Posty</p>
                            </div>
                            <div class="flex-1 inline-flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <p><span class="text-gray-900 font-bold">{{App\Models\Account::find($kid->account_id)->users->count()}}</span> Obserwujących</p>
                            </div>
                        </div>
                        <div class="px-4 pt-3 pb-4 border-t border-gray-300 bg-gray-100">
                            <div class="text-xs uppercase font-bold text-gray-600 tracking-wide">Rodzinka:</div>
                            <div class="flex items-center pt-2">
                                <div class="bg-cover bg-center w-10 h-10 rounded-full mr-3" style="background-image: url({{ asset('storage/'.$kid->kid_account_id.'/480/' . $kid->account_avatar) }})">
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900"><a href="{{ route('accounts.show',$kid->account_id) }}">{{$kid->kid_account}}</a></p>
                                    <p class="text-sm text-gray-700">Bombelków: {{App\Models\Account::find($kid->account_id)->kids->count()}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </x-app-layout>
