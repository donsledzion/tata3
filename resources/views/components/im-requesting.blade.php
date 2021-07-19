@if(!$im_requesting->isEmpty())
    <div id="followers">
        <div class="container mx-auto px-4 sm:px-2">
            <div class="py-8">
                <div>
                    <h2 class="text-2xl font-semibold leading-tight">{{__('kidbook.request.im_requesting')}}</h2>
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
                                    {{__('kidbook.misc.message')}}
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    {{__('kidbook.misc.actions')}}
                                </th>

                            </tr>
                            </thead>
                            <tbody>

                            @foreach($im_requesting as $request)
                                <tr>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <div class="flex items-center">

                                            <div class="ml-3">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    <a href="{{ route('accounts.show',$request->account->id) }}">{{$request->account->name}}</a>
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">{{__($request->message)}}</p>
                                    </td>

                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <button data-id="{{$request->id}}" data-class="requeststofollow" class="delete flex-no-shrink bg-red-500 hover:bg-red-600 px-5 ml-4 py-2 text-xs shadow-sm hover:shadow-lg font-medium tracking-wider border-2 border-red-400 hover:border-red-600 text-white rounded-full transition ease-in duration-300">
                                            {{__('kidbook.button.cancel')}}
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
    </div>
@endif
