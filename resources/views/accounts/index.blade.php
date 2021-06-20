
    <x-app-layout>
        <x-slot name="header">
            <div class="grid grid-cols-2">
                <div class="float-left">
                    <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Konta') }}
                    </h1>
                </div>
                <div class="float-right">
                    @if (Illuminate\Support\Facades\Gate::forUser(Illuminate\Support\Facades\Auth::user())->allows('create-account'))
                    <a class="float-right" href="{{route('accounts.create')}}">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Dodaj konto
                        </button>
                    </a>
                    @endif
                </div>
            </div>
        </x-slot>

        <!-- component -->

        <div class="table w-full p-2">
            <table class=   "w-full border">
                <thead>
                <tr class="bg-gray-50 border-b">
                    <th class="border-r p-2">
                        <input type="checkbox">
                    </th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                        <div class="flex items-center justify-center">
                            ID
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                            </svg>
                        </div>
                    </th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                        <div class="flex items-center justify-center">
                            Nazwa
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                            </svg>
                        </div>
                    </th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                        <div class="flex items-center justify-center">
                            Avatar
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                            </svg>
                        </div>
                    </th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                        <div class="flex items-center justify-center">
                            Bombelki
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                            </svg>
                        </div>
                    </th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                        <div class="flex items-center justify-center">
                            Użytkownicy
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                            </svg>
                        </div>
                    </th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                        <div class="flex items-center justify-center">
                            Działania
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                            </svg>
                        </div>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($accounts as $account)
                <tr class="bg-gray-100 text-center border-b text-sm text-gray-600">
                    <td class="p-2 border-r">
                        <input type="checkbox">
                    </td>
                    <td class="p-2 border-r">{{$account->id}}</td>
                    <td class="p-2 border-r">{{$account->name}}</td>
                    <td class="p-2 border-r">{{$account->avatar}}</td>
                    <td class="p-2 border-r">
                        @foreach($account->kids as $kid)
                                <div>{{$kid->dim_name}}</div>

                        @endforeach
                    </td>
                    <td class="p-2 border-r">
                        @foreach($account->users as $user)
                            <div>{{$user->email}}</div>

                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('accounts.show',$account->id) }}"     class="bg-green-500 p-2 text-white hover:shadow-lg text-xs fo   nt-thin">Podgląd</a>
                        <a href="{{ route('accounts.edit',$account->id) }}"     class="bg-blue-500 p-2 text-white hover:shadow-lg text-xs font-thin">Edit</a>
                        <button class="bg-red-500 p-2 delete text-white hover:shadow-lg text-xs font-thin" data-id="{{ $account->id }}">Usuń</button>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            {{ $accounts->links() }}
            @section('javascript')
                const deleteUrl = "{{ url('accounts') }}/" ;
            @endsection

            @section('js-files')
                <script src="{{ asset('js/delete.js') }}" ></script>
            @endsection
        </div>
    </x-app-layout>
