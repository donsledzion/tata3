@if(!$im_requested->isEmpty())
    <div id="followers">
        <div class="container mx-auto px-4 sm:px-2">
            <div class="py-8">
                <div>
                    <h2 class="text-2xl font-semibold leading-tight">{{__('kidbook.request.requests')}}</h2>
                </div>
                <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                    <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                        <table class="min-w-full leading-normal">
                            <thead>
                            <tr>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <p>{{__('kidbook.user.name')}}</p>
                                    <p>{{__('kidbook.user.email')}}</p>
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

                            @foreach($im_requested as $request)
                                <tr>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <div class="flex items-center">

                                            <div class="ml-3">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    {{$request->user->name}}
                                                </p>
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    {{$request->user->email}}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">{{$request->message}}</p>
                                    </td>

                                    <td class="px-5 py-5 flex border-b border-gray-200 bg-white text-sm">
                                        <button  data-id="{{$request->id}}" data-class="requeststofollow" data-action="POST" class="accept-deny flex-no-shrink bg-green-500 hover:bg-green-600 px-1 ml-0 py-1 text-xs shadow-sm hover:shadow-lg font-medium tracking-wider border-2 border-green-400 hover:border-green-600 text-white rounded-full transition ease-in duration-300">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        </button>
                                        <button data-id="{{$request->id}}" data-class="requeststofollow" data-action="DELETE" class="accept-deny flex-no-shrink bg-red-500 hover:bg-red-600 px-1 ml-0 py-1 text-xs shadow-sm hover:shadow-lg font-medium tracking-wider border-2 border-red-400 hover:border-red-600 text-white rounded-full transition ease-in duration-300">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
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
