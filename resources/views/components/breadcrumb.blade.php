<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
    <h2>{{ $name ?? '' }}</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/">Home</a>
            </li>
            <li class="breadcrumb-item active">
                <a href="{{$menuActive}}">
                    @php
                        $urls = explode("/", $menuActive);
                    @endphp
                    {{ucfirst($urls[3])}}
                </a>
            </li>
{{--            @if( !empty( $menuGroups->first()->first()->breadcrumbs(Route::currentRouteName()) ) )--}}
{{--                @foreach( $menuGroups->first()->first()->breadcrumbs(Route::currentRouteName()) as $key => $breadcrumbRow)--}}
{{--                    <li class="breadcrumb-item active">--}}
{{--                        {!! $breadcrumbRow !!}--}}
{{--                    </li>--}}
{{--                @endforeach--}}
{{--            @endif--}}
        </ol>
    </div>
</div>

