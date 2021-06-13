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
            cancelButtonText: 'Nie, pomyłka!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: "DELETE",
                    url: deleteUrl + $(this).data("id")
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
