@include('layouts.includes.profile')
<div class="sidebar-collapse">
    <ul class="nav metismenu" id="side-menu">
        <li class="nav-header">
            <div class="dropdown profile-element">
                <div class="image-upload">
                    <label for="file-input" style="cursor:pointer;" data-toggle="tooltip" title="Change picture">
                        <img id="image_user" alt="image" width="45px" class="rounded-circle" src="{{
                            isset(\Illuminate\Support\Facades\Auth::user()->image)
                            ? URL::asset('uploads/user/img/'.\Illuminate\Support\Facades\Auth::user()->image)
                            : URL::asset('assets/default-user-image.png')
                        }}"/>
                    </label>

                    <input onchange="getPict(this)" style="display: none;" id="file-input" type="file" name="upload_img"/>
                </div>
                <a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false">
                    <span class="block m-t-xs font-bold">{{ Auth::user()->email }}</span>
                    <span><small>as {{ Auth::user()->role }}</small><b class="caret"></b></span>
                </a>
                <ul class="dropdown-menu animated fadeInRight m-t-xs">
                    <li>
                        @if (Auth::user()->role == 'User Jurnal' || Auth::user()->role == 'Admin')
                            <a class="dropdown-item" onclick="profile()">Profile</a>
                        @endif
                        @if (Auth::user()->role == 'Supervisor')
                            <a class="dropdown-item" href="profile/{{ Auth::user()->id }}">Profile</a>
                        @endif
                    </li>
                    <li><a class="dropdown-item" href="#" onclick="changePassword()">Change Password</a></li>
                    {{-- <li><a class="dropdown-item" href="mailbox.html">Mailbox</a></li> --}}
                    <li class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">Logout</a><form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form></li>
                </ul>
            </div>
            <div class="logo-element">
                <img id="image_user" alt="image" width="40px" class="rounded-circle" src="{{
                    isset(\Illuminate\Support\Facades\Auth::user()->image)
                    ? URL::asset('uploads/user/img/'.\Illuminate\Support\Facades\Auth::user()->image)
                    : URL::asset('assets/default-user-image.png')
                }}"/>
                {{--                <img class="absolute2" src="{{URL::asset('theme/img/yems/asset-1.png')}}" alt="">--}}
            </div>
        </li>
        <li class="{{ request()->is('home*') ? 'active' : '' }}">
            <a href="{{ route('home')}}"><i class="fa fa-home"></i> <span class="nav-label">Dashboard</span></a>
        </li>
        @include('layouts/includes/sidebar-item')
    </ul>
</div>

@push('footer-scripts')
@if(auth()->user()->role == 'Admin')
    <script>
        // setInterval( function(){
        //     getPointChange();
        // }, 4000);
        // function getPointChange(){
        //     $.ajax({
        //         url:'point-log/get-point-change',
        //         method:'get',
        //         dataType:'json',
        //         success:function(response)
        //         {
        //             $('#notif-penukaran').html(response.data);
        //             $('#notif-home-penukaran').html(response.data);
        //         }
        //     })
        // }
    </script>
@endif
<script>
    function profile(){
        $('#button_edit').show();
        $('#detail_name').show();
        $('#detail_email').show();
        $('#profile-modal').modal('show');
        $('#profile-modal').appendTo('body');
        $('#edit_name').hide();
        $('#edit_email').hide();
        $('#button_submit').hide();
        var profileFormId = '#profileForm';
        $('.editdata').click(function () {
            $('#edit_name').show();
            $('#edit_email').show();
            $('#button_submit').show();
            $('#detail_name').hide();
            $('#detail_email').hide();
            $('#button_edit').hide();
            let id = $(this).data('id');
            $('[class^="invalid-feedback-"]').html('');  // clearing validation
            $.ajax({
                url:`{{url('user')}}/${id}/edit`,
                method:'get',
                data:{id:id},
                dataType:'json',
                success:function(response)
                {
                    // $('#profileForm input[name=_method]').attr('value','PUT');
                    $('.name').val(response.data.name);
                    $('#email').val(response.data.email);
                    // $('#inputModal').modal('show');
                    $(profileFormId).attr('action',`{{url('user/editprofile')}}/${response.data.id}`);
                    $('#modalTitle').html("Edit Profile");
                    $('#saveBtn').val("editprofile");
                }
            })
        });
        $(profileFormId).on('submit', function (event) {
            event.preventDefault();
            let url_action = $(profileFormId).attr('action');
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $(
                        'meta[name="csrf-token"]'
                    ).attr("content")
                },
                url: url_action,
                method: "POST",
                data: $(profileFormId).serialize(),
                dataType: 'json',
                beforeSend:function(){
                    let l = $( '.ladda-button-submit' ).ladda();
                    l.ladda( 'start' );
                    $('[class^="invalid-feedback-"]').html('');
                    $('#saveBtn').prop('disabled', true);
                },
                error: function(data){
                    let errors = data.responseJSON.errors;
                    if (errors) {
                        $.each(errors, function (index, value) {
                            $('div.invalid-feedback-'+index).html(value);
                        })
                    }
                },
                success: function (data) {
                    if (data.success) {
                        $('#profile-modal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Profile updated !',
                            text: data.success,
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            // footer: data.success
                        }).then((result) => {
                            if (result.isConfirmed) {
                                setTimeout(function () {
                                    window.location.reload();
                                }, 1000);
                            }
                        })
                    }
                },
                complete: function () {
                    let l = $( '.ladda-button-submit' ).ladda();
                    l.ladda( 'stop' );
                    $('#saveBtn'). prop('disabled', false);
                }
            });
        });
    }

    function getPict(input){
        var filedata = input.files[0];
        let imgtype = filedata.type;
        let imgsize = filedata.size;

        let match=["image/jpeg", "image/jpg", "image/png"];

        if((imgtype != match[0]) && (imgtype != match[1]) && (imgtype != match[2])){
            swal({
                title: "Upload Image Failed",
                text: "input file format only for: .jpeg, .jpg, .png !",
                type: "error"
            });
        } else if((imgsize < 5000) || (imgsize > 1000000)){
            swal({
                title: "Upload Image Failed",
                text: "input file size only between 5 KB - 1 MB !",
                type: "error"
            });
        } else{
            // IMAGE PREVIEW
            var reader = new FileReader();

            reader.onload=function(ev){
                $('#image_user').attr('src',ev.target.result);
            }
            reader.readAsDataURL(input.files[0]);

            // PROCESS UPLOAD
            var postData = new FormData();
            postData.append('file', input.files[0]);
            let url="/user/change-image";

            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $(
                        'meta[name="csrf-token"]'
                    ).attr("content")
                },
                url: url,
                method: "POST",
                async: true,
                contentType: false,
                cache: false,
                data: postData,
                processData:false,
                beforeSend:function(){
                    $('#saveButton').html('<strong>Saving...</strong>');
                    $('#saveButton'). prop('disabled', true);
                },
                success:function(data){
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Image uploaded',
                            text: data.success,
                            // footer: data.success
                        })
                        setTimeout(function () {
                            window.location.reload();
                        }, 2000);
                    }
                },
                error: function(data){
                    let html = '';
                    let errors = data.responseJSON.errors;
                    if (errors) {
                        let textError = '';
                        $.each(errors, function (index, value) {
                            textError += value;
                        });
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed to uploaded',
                            text:textError,
                            // footer: data.success
                        })
                    }
                },
            });
        }
    }
</script>
@endpush
