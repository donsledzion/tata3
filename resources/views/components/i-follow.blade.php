@if(!$families->isEmpty())
    <div class="container mx-auto px-4 sm:px-2">
        <div class="py-8">
            <div>
                <h2 class="text-2xl font-semibold leading-tight">{{__('kidbook.relation.watched')}}</h2>
            </div>

            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal">
                        <thead>
                        <tr>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                {{__('kidbook.account.account')}}
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                {{__('kidbook.kid.kids')}}
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                {{__('kidbook.post.posts')}}
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                {{__('kidbook.post.last')}}
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($families as $family)
                            <tr>
                                <td class="px-3 py-5 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-10 h-10">
                                            <img class="w-full h-full rounded-full"
                                                 @if(!empty($family->avatar))
                                                 src="{{ asset('storage/'.$family->id.'/160/' . $family->avatar) }}"
                                                 @else
                                                 src="{{ asset('storage/defaults/family_avatar.jpg') }}"
                                                 @endif
                                                 alt="avatar" />
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                <a href="{{ route('accounts.show',$family->id) }}">{{__($family->name)}}</a>
                                            </p>
                                            <button data-id="{{$family->permission(App\Models\User::find(\Illuminate\Support\Facades\Auth::id()))->id}}"
                                                    data-class="friends" class="delete flex-no-shrink bg-red-500 hover:bg-red-600 px-1 ml-0 py-1 text-xs shadow-sm hover:shadow-lg font-medium tracking-wider border-2 border-red-400 hover:border-red-600 text-white rounded-full transition ease-in duration-300">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-3 py-5 border-b border-gray-200 bg-white text-sm">
                                    @foreach($family->kids as $kid)
                                        <p class="text-gray-900 whitespace-no-wrap">{{$kid->dim_name}}</p>
                                    @endforeach

                                </td>
                                <td class="px-3 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{$family->posts->count()}}
                                    </p>
                                </td>
                                <td class="px-3 py-5 border-b border-gray-200 bg-white text-sm">
                                    <span
                                        class="relative inline-block px-1 py-1 font-semibold text-green-900 leading-tight">
                                        <span aria-hidden
                                              class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                        @if($family->lastPost())
                                            <span class="relative">{{$family->lastPost()->said_at}}</span>
                                        @else
                                            <span class="relative">{{__('kidbook.misc.none')}}</span>
                                        @endif
                                    </span>
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
