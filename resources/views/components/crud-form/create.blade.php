<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Add New {{$name}}</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="fullscreen-link">
                        <i class="fa fa-expand"></i>
                    </a>
                    {{-- <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a> --}}
                </div>
            </div>
                               
            <div class="ibox-content">
                <form method="post" action="{{$action}}" id="{{$id}}">
                @csrf
                <!-- CSRF untuk keamanan --> 
                {{ $formCreate }}

                <div class="hr-line-dashed m-b-lg"></div>
                <div class="form-group row justify-content-center">
                    <a href="{{ url()->previous() }}" class="btn btn-warning btn-lg m-xs" title="Kembali"><i
                                class="fa fa-reply"></i></a>
                    <button class="btn btn-white btn-lg m-xs" type="reset">Reset</button>
                    <button class="btn btn-primary btn-lg m-xs" type="submit">Save</button>
                </div>                    
                </form>
            </div>
        </div>
    </div>
</div>