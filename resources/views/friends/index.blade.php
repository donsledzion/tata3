
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('kidbook.relation.friends') }}
        </h2>
    </x-slot>

    <!-- component -->
    <div id="find-form" class="mt-8">

        <div class="mx-auto max-w-lg ">
            <!-- INVITING FORM -->
            <x-find-user :account="$account" :user="$user" :permissions="$permissions" />

            <!-- EXISTING INVITATIONS SECTION -->
                <!-- I'M INVITED SECTION -->
                <x-im-requested :user="$user"/>

                <x-im-requesting :user="$user"/>

                <!-- END OF SECTION: I'M INVITED -->

                <!-- I'M INVITED SECTION -->
                <x-im-invited :user="$user"/>
                <!-- END OF SECTION: I'M INVITED -->

                <!-- I'M INVITING SECTION -->
                <x-im-inviting :user="$user"/>
                <!-- END OF I'M INVITING SECTION -->
            <!-- END OF EXISTING INVITATIONS AND REQUESTS SECTION -->

            <!-- FOLLOWERS SECTION -->
            <x-im-followed/>
            <!--END OF FOLLOWERS SECTION -->

            <!--WATCHED SECTION -->
            <x-i-follow :user="$user"/>
            <!--END OF WATCHED SECTION -->


        </div>
    </div>

    </div>

    @section('javascript')
        const contents ="Czy na pewno chcesz anulować zaproszenie?";
        const yesResponse ="TAK";
        const noResponse ="NIE";
        const deleteUrl = "{{ url('') }}/" ;
        const baseUrl = "{{ url('') }}/" ;
        const findUrl = "{{ url('users/find_by_email') }}/" ;
        const friendsUrl = "{{ url('friends') }}/" ;
        const confirmDelete = "{{ __('kidbook.messages.delete_confirm') }}";
        $(function(){
            $('.find-user').click(function(){
                $('#user-found-response').hide();
                    var email = document.getElementById('email').value;
                    $.ajax({
                    method: "GET",
                    url: findUrl + email
                })
                .done(function(data) {
                    $('#user-found-response').show();
                    $('#invited_id').val(data.user.id);
                    $('#found-name').val(data.user.name);
                    $('#found-email').val(data.user.email);
                })
                .fail(function(data){
                    Swal.fire({
                        icon: 'error',
                        title: 'Ups...',
                        text: data.responseJSON.message + ''
                    });
                });
            });
        });

        $(function(){
        $('.accept-deny').click(function(){
            console.log("clicked-accept-deny-button");
            var invitation_id = $(this).data('id');
            var requestUri = $(this).data('class');
            var action = $(this).data('action');
            $.ajax({
                method: action,
                url: baseUrl + requestUri + "/" + invitation_id
            })
            .done(function(data) {
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
                    text: data.responseJSON.message + ''
                });
            });
        });
    });


    $(function(){
        $('.send-invitation').click(function(){
            console.log("send-invitation-button");
            var invited_id = $('#invited_id').val();
            var inviting_id = $('#inviting_id').val();
            var account_id = $('#account_id').val();
            var message = $('#message').val();
            var permission_id = $('#permission_id').val();
            var requestUri = $(this).data('class');
            $.ajax({
                method: "POST" ,
                url: baseUrl + requestUri ,
                data: {"account_id": account_id, "inviting_id": inviting_id , "invited_id": invited_id, "permission_id": permission_id, "message": message}
            })
            .done(function(data) {
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
                text: data.responseJSON.message + ''
                });
            });
        });
    });

    $(function(){
        $('.followed_permission_select').change(function() {
            var selected_option = $(this).val();
            var permission_id = $(this).data('id');
            $('#edit-button-' + permission_id).show();
        });
    });

    $(function(){
        $('.update-permissions').click(function(){
            if($(this).hidden){
                console.log('...button should be hidden :/');
            } else {
                var relation_id = $(this).data('id');
                var permission = $('#permission-select-' + relation_id).val();
        $.ajax({
                method: "PUT" ,
                url: baseUrl + "accountuserpermission/" + relation_id ,
                data: {"permission_id": permission, "relation_id": relation_id}
            }).done(function(data) {
                Swal.fire({
                    icon: 'success',
                    title: 'Gratulacje',
                    text: data.message + ''
                }).then((result)=>{
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });
            }).fail(function(data){
                    Swal.fire({
                        icon: 'error',
                        title: 'Ups...',
                        text: data.responseJSON.message + ''
                    });
                });
            }
        });

    });

    @endsection

    @section('js-files')
        <script src="{{ asset('js/delete.js') }}" ></script>
    @endsection
</x-app-layout>
