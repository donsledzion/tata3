
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('kidbook.post.posts') }}
                <a href="{{route('posts.create')}}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 inline animate-pulse" fill="none" viewBox="0 0 24 24" stroke="green">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                </a>
            </h2>
        </x-slot>

        <!-- component -->
        <div class="table w-full p-2">
        <!-- -->
        <div class="py-20 bg-gray-300">
            <div id="data-wrapper">
                <!-- Results -->

            </div>

            <!-- Data Loader -->
            <div class="auto-load text-center">

            </div>

        </div>

        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        @section('javascript')
            const deleteUrl = "{{ url('') }}/" ;
            const confirmDelete = "{{ __('kidbook.messages.delete_post_confirm') }}";
            const contents = "{{ __('kidbook.messages.delete_post_contents') }}";
            const yesResponse = "{{ __('kidbook.messages.yes_response') }}";
            const noResponse = "{{ __('kidbook.messages.no_response') }}";
        @endsection
        @section('js-files')
            {{--<script src="{{ asset('js/delete.js') }}" ></script>--}}

            {{--<script src="{{ asset('js/send_request.js') }}" ></script>--}}

            <script src="{{ asset('js/postsfeed.js') }}" ></script>
        @endsection

    </x-app-layout>
