@extends('layouts.master')

@section('content')
    @component('components.delete-modal', ['name' => 'Data User'])
    @endcomponent

    @include('pages.admin.users.modal')

    @component('components.crud-form.index',[
                    'title' => 'Data User',
                    'tableId' => 'user-table'])

        @slot('createButton')
            <button type="button" id="create" class="btn btn-primary btn-lg">
                <i class="fa fa-plus-circle"></i>&nbsp;Tambah
            </button>
        @endslot

        @slot('tableContent')
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Aksi</th>
        @endslot
    @endcomponent

    @include('components.admin.user-script')

@endsection

@push('header-scripts')
    @include('layouts.includes._header-datatable-script')
@endpush
@push('footer-scripts')
    @include('layouts.includes._footer-datatable-script')
@endpush
