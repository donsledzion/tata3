
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Cytaty') }}
            </h2>
        </x-slot>

        <!-- component -->

        <!-- -->
        <div class="py-40 bg-gray-300">
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
                            $('.auto-load').html("We don't have more data to display :(");
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
