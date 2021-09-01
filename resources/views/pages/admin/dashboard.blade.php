@extends('layouts.master')

@push('footer-scripts')
    <script>
        $(document).ready(function () {
            $( "#belum-akreditasi" ).on('click', function() {
                //console.log("belum akreditasi")
                $(this).addClass('button-clicked');
                var options = {
                    'backdrop' : 'static'
                };
                $('#belum-akreditasi-modal').modal(options)
            });
        });
    </script>
@endpush

@section('content')
    <div class="row border-bottom white-bg dashboard-header">
        <div class="col-sm-6 col-xs-12">
            <h1>Selamat datang Admin</h1>
        </div>
    </div>

    @include('components.admin.dashboard-script')
@endsection

@push('header-scripts')
    @include('layouts.includes._header-datatable-script')
@endpush
@push('footer-scripts')
    @include('layouts.includes._footer-datatable-script')
@endpush
