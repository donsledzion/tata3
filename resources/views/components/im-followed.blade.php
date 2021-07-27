@if($followers)
    <div class="container mx-auto px-4 sm:px-2">
        <div class="py-8">
            <div>
                <h2 class="text-2xl font-semibold leading-tight">{{__('kidbook.relation.followers')}}</h2>
            </div>
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal">
                        <thead>
                        <tr>
                            <th
                                class="px-3 py-2 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                {{__('kidbook.user.name')}}  {{__('kidbook.user.email')}}
                            </th>
                            <th
                                class="px-8 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                {{__('kidbook.relation.relation')}}
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                {{__('kidbook.misc.actions')}}
                            </th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($followers as $follower)
                            <tr>
                                <td class="px-3 py-5 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex items-center">

                                        <div class="ml-3">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{$follower->name}}
                                            </p>
                                            <p class="text-gray-900 whitespace-no-wrap">{{$follower->email}}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <select id="permission-select-{{$follower->permission()->id}}"
                                            data-id="{{$follower->permission()->id}}"
                                            class="followed_permission_select text-xs block px-2 py-1 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">
                                        @foreach($permissions as $permission)
                                        <option value="{{$permission->id}}" class=""

                                        @if($follower->permission()->permission->id == $permission->id)
                                            selected
                                        @endif
                                        >
                                            {{__($permission->name)}}

                                        </option>
                                        @endforeach
                                    </select>

                                </td>

                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">

                                    <button hidden id="edit-button-{{$follower->permission()->id}}" data-id="{{$follower->permission()->id}}"
                                            data-class="permissions" class="update-permissions flex-no-shrink bg-green-500 hover:bg-green-600 px-1 ml-0 py-1 text-xs shadow-sm hover:shadow-lg font-medium tracking-wider border-2 border-green-400 hover:border-green-600 text-white rounded-full transition ease-in duration-300">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    </button>


                                    <button data-id="{{$follower->permission()->id}}"
                                            data-prompt="{{__('kidbook.prompt.question.unplug')}}"
                                            data-class="friends" class="delete flex-no-shrink bg-red-500 hover:bg-red-600 px-1 ml-0 py-1 text-xs shadow-sm hover:shadow-lg font-medium tracking-wider border-2 border-red-400 hover:border-red-600 text-white rounded-full transition ease-in duration-300">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>

                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endif
