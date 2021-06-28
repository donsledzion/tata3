
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Cytaty') }}
                <a href="{{route('posts.create')}}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                </a>
            </h2>
        </x-slot>

        <!-- component -->

        <!-- -->
        <div class="py-20 bg-gray-300">
            <div id="data-wrapper">
                <!-- Results -->

            </div>

            <!-- Data Loader -->
            <div class="auto-load text-center">

            </div>

        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            var ENDPOINT = "{{ url('/') }}";
            var page = 1;
            infinteLoadMore(page);

            $(window).scroll(function () {
                if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
                    page++;
                    infinteLoadMore(page);
                }
            });

            function infinteLoadMore(page) {
                $.ajax({
                    url: ENDPOINT + "/postsfeed?page=" + page,
                    datatype: "html",
                    type: "get",
                    beforeSend: function () {
                        $('.auto-load').show();
                    }
                })
                    .done(function (response) {
                        if (response.length == 0) {
                            $('.auto-load').html("Niestety, nie ma nic więcej do wyświetlenia :(");
                            return;
                        }
                        $('.auto-load').hide();
                        $("#data-wrapper").append(response);
                    })
                    .fail(function (jqXHR, ajaxOptions, thrownError) {
                        console.log('Server error occured');
                    });
            }

        </script>
        @section('js-files')
            <script src="{{ asset('js/delete.js') }}" ></script>
        @endsection
    </x-app-layout>
