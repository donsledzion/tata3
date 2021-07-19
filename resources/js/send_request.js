$(function(){
    $('.follow-button').click(function(e){
        console.log('hejże - ho!');
        e.preventDefault();
        var account_id = $(this).data("account");
        var requesting_id = $(this).data("user");
        var message = $(this).data("message");
        (async () => {

            const { value: text } = await Swal.fire({
                input: 'textarea',
                inputLabel: 'Prośba o dołączenie:',
                inputPlaceholder: 'Tutaj możesz wpisać wiadomość do rodziców konta Bombelka, którego chcesz obserwować...',
                inputAttributes: {
                    'aria-label': 'Tutaj możesz wpisać wiadomość do rodziców konta Bombelka, którego chcesz obserwować...'
                },
                showCancelButton: true
            })

            if (text) {
                message = text;
            }
            console.log("account_id:"+ account_id + ", requesting_id: " + requesting_id +", message: " + message);
            $.ajax({
                type: "POST",
                url: "/requeststofollow",
                data: {"account_id": account_id, "requesting_id": requesting_id,"message": message},
            }).done(function( data ) {
                Swal.fire({
                    icon: 'success',
                    title: 'Udało się!',
                    text: data.message
                });
            }).fail(function(data){
                Swal.fire({
                    icon: 'error',
                    title: 'Ups...',
                    text: data.responseJSON.message
                });
            });
        })()

    });
});
