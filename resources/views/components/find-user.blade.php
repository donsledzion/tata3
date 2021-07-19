
@if($account)
<div>
    <!-- Smile, breathe, and go slowly. - Thich Nhat Hanh -->

        <div class="text-center font-semibold text-black">
            {{__('kidbook.relation.title')}}
        </div>
        <div class="py-1">
            <span class="px-1 text-sm text-gray-600">{{__('kidbook.user.email')}}</span>
            <input id="email" name="email" placeholder="" type="email" value="{{old('email')}}" required
                   class="text-md block px-3 py-2 rounded-lg w-full
                                                bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"/>
        </div>


        <button class="mt-3 text-lg font-semibold find-user
                                        bg-gray-800 w-full text-white rounded-lg
                                        px-6 py-3 block shadow-xl hover:text-white hover:bg-black">
            {{ __('kidbook.button.user_check') }}
        </button>



        <div id="user-found-response" class="container max-w-full mx-auto md:py-8 px-6" hidden>
            <div class="max-w-sm mx-auto px-6">
                <div class="relative flex flex-wrap">
                    <div class="w-full relative">
                        <div class="md:mt-6">
                            <div class="text-center font-semibold text-black">
                                {{__('kidbook.user.found')}}
                            </div>


                                <input type="text" name="invited_id" id="invited_id" value=""  hidden>
                                <input type="text" name="inviting_id" id="inviting_id" value="{{$user->id}}"  hidden>
                                <input type="text" name="account_id" id="account_id" value="{{$account->id}}"  hidden>
                                <div class="mx-auto max-w-lg ">
                                    <div class="py-1">
                                        <span class="px-1 text-sm text-gray-600">{{__('kidbook.user.name')}}</span>
                                        <input id="found-name" name="found-name" placeholder="" type="text" value="" required disabled
                                               class="text-md block px-3 py-2 rounded-lg w-full
                                                bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"/>
                                    </div>

                                    <div class="py-1">
                                        <span class="px-1 text-sm text-gray-600">{{__('kidbook.user.email')}}</span>
                                        <input id="found-email" name="found-email" placeholder="" type="email" value="" required disabled
                                               class="text-md block px-3 py-2 rounded-lg w-full
                                                bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"/>
                                    </div>

                                    <div class="py-1">
                                        <span class="px-1 text-sm text-gray-600">{{__('kidbook.relation.invite_as')}}</span>
                                        <select name="permission_id" id="permission_id"
                                                class="text-md block px-3 py-2 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">
                                            @foreach($permissions as $permission)
                                                <option value="{{$permission->id}}" @if($permission->default) selected @endif>{{__($permission->name)}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="py-1">
                                        <span class="px-1 text-sm text-gray-600">{{__('kidbook.misc.message')}}: {{__('kidbook.misc.optional')}}</span>
                                        <textarea id="message" name="message" rows="6" class="text-md block px-3 py-2 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-600
                                         shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"></textarea>
                                    </div>
                                    <div class="flex justify-start mt-3 ml-4 p-1">
                                        <ul>


                                        </ul>
                                    </div>

                                    <button class="send-invitation mt-3 text-lg font-semibold
                                        bg-gray-800 w-full text-white rounded-lg
                                        px-6 py-3 block shadow-xl hover:text-white hover:bg-black"
                                        data-class="invitations"
                                    >
                                        {{ __('kidbook.button.invite') }}
                                    </button>
                                </div>


                        </div>

                    </div>
                </div>
            </div>
        </div>


        <div id="user-not-found-response">

        </div>

</div>
@endif
