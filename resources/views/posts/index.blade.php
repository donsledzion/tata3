
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Quotes') }}
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
        @endsection


        <script>
            var ENDPOINT = "{{ url('/') }}";
            var page = 1;
            infinteLoadMore(page);

            $(window).scroll(function () {

                if ($(window).scrollTop() + $(window).innerHeight() >= $(document).height()-100) {
                    page++;
                    infinteLoadMore(page);
                    sleep(500);
                }
            });

            function sleep(milliseconds) {
                let timeStart = new Date().getTime();
                while (true) {
                    let elapsedTime = new Date().getTime() - timeStart;
                    if (elapsedTime > milliseconds) {
                        break;
                    }
                }
            }

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
                        $(function(){
                            $('.delete').click(function(){
                                Swal.fire({
                                    title: 'Usunąć wpis?',
                                    text: "Tej operacji nie da się cofnąć!",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Tak, usuń!',
                                    cancelButtonText: 'Oj nie!'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        $.ajax({
                                            method: "DELETE",
                                            url: deleteUrl + $(this).data("class") + "/" + $(this).data("id")
                                        })
                                            .done(function( response ) {
                                                window.location.reload();
                                            })
                                            .fail(function(data){
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Ups...',
                                                    text: data.responseJSON.message
                                                });
                                            });
                                    }
                                })

                            });
                        });
                    })
                    .fail(function (jqXHR, ajaxOptions, thrownError) {
                        console.log('Server error occured');
                    });
            }

        </script>


    </x-app-layout>
