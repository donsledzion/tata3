
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Cytaty') }}
            </h2>
        </x-slot>

        <!-- component -->

        <!-- -->
        <div class="py-40 bg-gray-300">
            @foreach($posts as $post)
            <div class="h-screen px-2">
                <div class="max-w-md mx-auto bg-white shadow-lg rounded-md overflow-hidden md:max-w-md">
                    <div class="md:flex">
                        <div class="w-full">
                            <div class="flex justify-between items-center p-3">
                                <div class="flex flex-row items-center"> <img src="{{ asset('storage/'.$post->kid_account_id.'/160/' . $post->kid_default_picture)}}" class="rounded-full" width="40">
                                    <div class="flex flex-row items-center ml-2"> <span class="font-bold mr-1">{{$post->kid_dim_name}}</span> <small class="h-1 w-1 bg-gray-300 rounded-full mr-1 mt-1"></small> <a href="#" class="text-blue-600 text-sm hover:text-blue-800">Follow</a> </div>
                                </div>
                                <div class="pr-2"> <i class="fa fa-ellipsis-h text-gray-400 hover:cursor-pointer hover:text-gray-600"></i> </div>
                            </div>
                            <div class="flex justify-between items-center p-3">
                                <blockquote>
                                <i>{{$post->sentence}}</i>
                                </blockquote>
                            </div>
                            <div> <img src="{{ asset('storage/'.$post->kid_account_id.'/480/' . $post->picture) }}" class="w-full h-75"> </div>
                            <div class="flex flex-row right-0 p-2">
                                <b>{{$post->said_at}}</b>
                            </div>
                            <div class="p-4 flex justify-between items-center">
                                <div class="flex flex-row items-center"> <i class="fa fa-heart-o mr-2 fa-1x hover:text-gray-600"></i> <i class="fa fa-comment-o mr-2 fa-1x hover:text-gray-600"></i> <i class="fa fa-send-o mr-2 fa-1x hover:text-gray-600"></i> </div>
                                <div> <i class="fa fa-bookmark-o fa-1x hover:text-gray-600"></i> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
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
                    url: ENDPOINT + "/posts?page=" + page,
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
    </x-app-layout>
