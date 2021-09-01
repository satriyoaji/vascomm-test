<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Register | {{ config('app.name', 'Laravel') }}</title>

    <!-- Ladda style -->
    <link href="{{URL::asset('theme/css/plugins/ladda/ladda-themeless.min.css')}}" rel="stylesheet">

    <!-- Favicons -->
    <link href="{{URL::asset('assets/logo-rji.jpg')}}" rel="icon">
    <link href="{{URL::asset('assets/logo-rji.jpg')}}" rel="apple-touch-icon">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
{{--    {!! \Anhskohbo\NoCaptcha\Facades\NoCaptcha::renderJs(App::getLocale()) !!}--}}

    <style>
        html,
        body {
            height: 100%
        }

        body {
            background-color: #edefed;
            display: grid;
            place-items: center
        }

        .card {
            padding: 0px 15px;
            border-radius: 20px
        }

        .c1 {
            background-color: #d4f0ee;
            border-radius: 20px
        }

        a {
            margin: 0px;
            font-size: 13px;
            border-radius: 7px;
            text-decoration: none;
            color: black
        }

        a:hover {
            color: #2b98c1;
            background-color: #fff2f1
        }

        .nav-link {
            padding: 1rem 1.4rem;
            margin: 0rem 0.7rem
        }

        .ac {
            font-weight: bold;
            color: #2b98c1;
            font-size: 12px
        }

        input,
        button {
            width: 100%;
            background-color: #fff2f1;
            border-radius: 8px;
            padding: 8px 17px;
            font-size: 13px;
            border: 1px solid #f5f0ef;
            color: #dccece
        }

        input {
            text-decoration: none
        }

        .bt {
            background-color: #356fdd;
            border: 1px solid rgb(164, 209, 255)
        }

        form {
            margin-top: 70px
        }

        form>* {
            margin: 10px 0px
        }

        #forgot {
            margin: 0px -60px
        }

        #register {
            text-align: center
        }

        img {
            background-color: antiquewhite
        }

        .wlcm {
            font-size: 30px
        }

        .sp1 {
            font-size: 5px
        }

        .sp1>span {
            background-color: #8195db
        }
    </style>
</head>
<body>
{{--<img class="absolute" src="{{URL::asset('theme/img/yems/smartaircraft logo putih.png')}}" alt="">--}}
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-12 col-lg-11 col-xl-10">
            <div class="card d-flex mx-auto my-5">
                <div class="row">
                    <div class="col-md-8 col-sm-12 col-xs-12 c1 pt-5">
                        <div class="row mb-5 m-3">
                            {{--                                <img src="{{URL::asset('assets/logo-rji.jpg')}}" width="70vw" height="55vh" alt="">--}}
                        </div>
                        <img style="background: none;" src="{{URL::asset('assets/img/apps.svg')}}" width="400vw" height="280vh" class="mx-auto d-flex" alt="Register Apps">
                        <div class="row justify-content-center">
                            <div class="w-75 mx-md-5 mx-1 mx-sm-2 mb-5 mt-4 px-sm-5 px-md-2 px-xl-1 px-2">
                                <h2 class="wlcm">Silahkan Registrasi Aplikasi</h2>
                                <h3 class="wlcm">{{ str_replace('_', ' ', config('app.name', 'Jurnal Monitoring')) }}</h3>
                                <span class="sp1"> <span class="px-3 bg-danger rounded-pill"></span> <span class="ml-2 px-1 rounded-circle"></span> <span class="ml-2 px-1 rounded-circle"></span> </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12 c2 px-5 p-5">
                        {{--                            <div class="row">--}}
                        {{--                                <nav class="nav font-weight-500 mb-1 mb-sm-2 mb-lg-5 px-sm-2 px-lg-5 text-center"><h3>Login Here</h3> </nav>--}}
                        {{--                            </div>--}}
                        <form class="m-t" method="POST" enctype="multipart/form-data" id="registerForm">
                            @csrf
                            <div class="d-flex">
                                <h4 class="font-weight-bold">Daftar di sini</h4>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus placeholder="Name">
{{--                                @error('name')--}}
                                    <span class="text-danger text-sm-left invalid-feedback-name" role="alert">
{{--                                    <strong>{{ $message }}</strong>--}}
                                    </span>
{{--                                @enderror--}}
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus placeholder="email">
{{--                                @error('email')--}}
                                <span class="text-danger text-sm-left invalid-feedback-email" role="alert">
{{--                                    <strong>{{ $message }}</strong>--}}
                                </span>
{{--                                @enderror--}}
                            </div>
                            <div class="form-group">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="password">
{{--                                @error('password')--}}
                                    <span class="text-danger text-sm-left invalid-feedback-password" role="alert">
{{--                                    <strong>{{ $message }}</strong>--}}
                                    </span>
{{--                                @enderror--}}
                            </div>
                            <div class="form-group mt-2 mb-1">
                                <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required placeholder="password confirmation">
{{--                                @error('password_confirmation')--}}
                                <span class="text-danger text-sm-left invalid-feedback-password_confirmation" role="alert">
{{--                                    <strong>{{ $message }}</strong>--}}
                                </span>
{{--                                @enderror--}}
                            </div>
                            <div class="form-group mt-2 mb-1">
                                <div class="col-sm-12 custom-file">
                                    <input type="file" class="custom-file-input @error('image') is-invalid @enderror" name="image" id="image">
                                    <label class="custom-file-label image_label" for="image">
                                        {{$data->image ?? 'Foto Selfie'}}
                                    </label>
                                    @error('image')
                                    <span class="text-danger text-sm-left invalid-feedback-image" role="alert">
{{--                                        <strong>{{ $message }}</strong>--}}
                                    </span>
                                    @enderror
                                    <div class="text-warning font-italic text-small">
                                        format file: jpeg,png,jpg
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
{{--                                {!! \Anhskohbo\NoCaptcha\Facades\NoCaptcha::display() !!}--}}
                            </div>

                            <button type="submit" id="registerBtn" class="text-white text-weight-bold bt">Register</button>
                            <a style="text-decoration: none;" href="{{route('login')}}">
                                <h5 class="ac" id="register">to Login</h5>
                            </a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // $(document).ready(function () {
    //     $('.g-recaptcha div').first().css("width", "100%");
    // })
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Ladda -->
<script src="{{URL::asset('theme/js/plugins/ladda/spin.min.js')}}"></script>
<script src="{{URL::asset('theme/js/plugins/ladda/ladda.min.js')}}"></script>
<script src="{{URL::asset('theme/js/plugins/ladda/ladda.jquery.min.js')}}"></script>

<script>
  $(document).ready(function () {
    function generateToast (type, data) {
      this.type = type;
      this.data = data;

      $('.notif').removeAttr('class').attr('class', 'notif');

      if (type == "success") {
        $('#notifTitle').html("Success");
        $('#notifMessage').html(data);
        $('.notif').addClass('toast');
        $('.notif').addClass('toast-success');
        $('.notif').addClass('animated');
        $('.notif').addClass('slideInRight');
        $('.notif').toast('show');
      }

      else if (type == "error") {
        $('#notifTitle').html("Error");
        $('#notifMessage').html(data);
        $('.notif').addClass('toast');
        $('.notif').addClass('toast-danger');
        $('.notif').addClass('animated');
        $('.notif').addClass('slideInRight');
        $('.notif').toast('show');
      }
    }

    var inputFormId = '#registerForm';

    $(inputFormId).on('submit', function (event) {
      event.preventDefault();

      let url_action = '/register';
      let formData = new FormData(this);

      $.ajax({
        headers: {
          "X-CSRF-TOKEN": $(
            'meta[name="csrf-token"]'
          ).attr("content")
        },
        url: url_action,
        method: "POST",
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        beforeSend:function(){
          let l = $( '.ladda-button-submit' ).ladda();
          l.ladda( 'start' );
          $('[class^="invalid-feedback-"]').html('');
          $('#registerBtn').prop('disabled', true);
        },
        error: function(data){
          let errors = data.responseJSON.errors;
          if (errors) {
            $.each(errors, function (index, value) {
              $('span.invalid-feedback-'+index).html(value);
            })
          }
        },
        success: function (data) {
          console.log(data.status)
          if (data.status == 200) {
            window.location = "/login";
            setTimeout(function(){
              generateToast ('success', data.success);
            }, 2000);
          }
          else {
            swal.fire({
              titleText: "Action Failed",
              text: data.error,
              icon: "error",
            });
          }
        },
        complete: function () {
          let l = $( '.ladda-button-submit' ).ladda();
          l.ladda( 'stop' );
          $('#registerBtn'). prop('disabled', false);
        }
      });
      // $('#description').summernote('code', '');
    });
  });

</script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
</body>

</html>

