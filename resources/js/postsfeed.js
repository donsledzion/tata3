var parameter = "" ;

if($("#feeds-param").val()){
    parameter = '/kid/' + $('#feeds-param').val();
}

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
        url: deleteUrl + "postsFeed" + parameter + "?page=" + page,
        datatype: "html",
        type: "get",
        beforeSend: function () {
            $('.auto-load').show();
        }
    })
        .done(function (response) {
            if (response.length === 0) {
                $('.auto-load').html("Niestety, nie ma nic więcej do wyświetlenia :(");
                return;
            }
            $('.auto-load').hide();
            $("#data-wrapper").append(response);
            $(function(){
                $('.delete').click(function(){
                    Swal.fire({
                        title: confirmDelete,
                        text: contents,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: yesResponse,
                        cancelButtonText: noResponse
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                method: "DELETE",
                                url: deleteUrl + $(this).data("class")+ "/" + $(this).data("id")
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
            $(function(){
                $('.follow-button').click(function(e){
                    e.preventDefault();
                    var account_id = $(this).data("account");
                    var requesting_id = $(this).data("user");
                    var message = $(this).data("message");
                    (async () => {

                        const {value: text} = await Swal.fire({
                            input: 'textarea',
                            inputLabel: 'Prośba o dołączenie:',
                            inputPlaceholder: 'Tutaj możesz wpisać wiadomość do rodziców konta Bombelka, którego chcesz obserwować...',
                            inputAttributes: {
                                'aria-label': 'Tutaj możesz wpisać wiadomość do rodziców konta Bombelka, którego chcesz obserwować...'
                            },
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: "Wyślij",
                            cancelButtonText: "Anuluj"
                        }).then((result) => {
                            if (result.isConfirmed) {

                            if (text) {
                                message = text;
                            }
                            $.ajax({
                                type: "POST",
                                url: "/requeststofollow",
                                data: {"account_id": account_id, "requesting_id": requesting_id, "message": message},
                            }).done(function (data) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Udało się!',
                                    text: data.message
                                });
                            }).fail(function (data) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Ups...',
                                    text: data.responseJSON.message
                                });
                            });
                        }})
                    })()
                });
            });


        })
        .fail(function (jqXHR, ajaxOptions, thrownError) {
            console.log('Server error occured');
        });
}
