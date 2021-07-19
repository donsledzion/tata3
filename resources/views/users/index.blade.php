
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('My friends') }}
            </h2>
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
                            Email
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                            </svg>
                        </div>
                    </th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                        <div class="flex items-center justify-center">
                            Status
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
                @foreach($users as $user)
                <tr class="bg-gray-100 text-center border-b text-sm text-gray-600">
                    <td class="p-2 border-r">
                        <input type="checkbox">
                    </td>
                    <td class="p-2 border-r">{{$user->id}}</td>
                    <td class="p-2 border-r">{{$user->name}}</td>
                    <td class="p-2 border-r">{{$user->email}}</td>
                    <td class="p-2 border-r">{{$user->status}}</td>
                    <td>
                        <button class="bg-blue-500 p-2 edit text-white hover:shadow-lg text-xs font-thin" data-id="{{ $user->id }}">Edytuj</button>
                        <button class="bg-red-500 p-2 delete text-white hover:shadow-lg text-xs font-thin" data-id="{{ $user->id }}">Usuń</button>>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            @section('javascript')
                const deleteUrl = "{{ url('users') }}/" ;
                const confirmDelete = "{{ __('kidbook.messages.delete_user_confirm') }}";
                const contents = "{{ __('kidbook.messages.delete_user_contents') }}";
                const yesResponse = "{{ __('kidbook.messages.yes_response') }}";
                const noResponse = "{{ __('kidbook.messages.no_response') }}";

            @endsection

            @section('js-files')
                <script src="{{ asset('js/delete.js') }}" ></script>
            @endsection
        </div>

    </x-app-layout>
