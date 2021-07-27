$(function(){
    $('.delete').click(function(){
        Swal.fire({
            title: confirmDelete,
            text: $(this).data("prompt"),
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
                    .done(function( data ) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Gratulacje',
                            text: data.message + ''
                        }).then((result)=>{
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        });
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
