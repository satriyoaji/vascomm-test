<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ auth()->user()->role ?? 'User' }} Page | {{ config('app.name') }}</title>
    @stack('header-scripts')
    @include('layouts.includes._header-script')
</head>
<body>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            @include('layouts.includes.sidebar')
        </nav>

        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    @include('layouts.includes.navbar')
                </nav>
            </div>

            @if (Request::is('dashboard'))
                @yield('content')
            @else
                @yield('page-heading')

                @include('components.breadcrumb')
                <div class="wrapper wrapper-content animated fadeInRight">
                    @yield('content')
                </div>
            @endif

            <div class="footer position-fixed">
                <strong>Copyright</strong> Jurnal UMY &copy; {{ date('Y') }}
            </div>

            @include('components.toast.toast')
        </div>
    </div>

<script>
    function isJson(str) {
        try {
            JSON.parse(str);
        } catch (e) {
            return false;
        }
        return true;
    }
</script>

@include('layouts.includes._footer-script')
@stack('footer-scripts')
</body>
</html>
