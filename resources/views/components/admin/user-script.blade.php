@include('components.toast.script-generate')
@include('components.crud-form.basic-script-submit')

@push('footer-scripts')
<script>
    $(document).ready(function () {
        var actionUrl = "{{ route('user.store') }}";
        var tableId = '#user-table';
        var inputFormId = '#inputForm';

        var datatableObject = $(tableId).DataTable({
            pageLength: 25,
            processing: true,
            serverSide: false,
            searchDelay: 1000,
            ajax: {
                url: "{{ route('user.index') }}",
            },
            columns: [
                { data:'no', name: 'No'},
                { data: 'name', name: 'Nama', defaultContent: '-', className: 'text-left'},
                { data: 'email', name: 'Email', defaultContent: '-', className: 'text-left'},
                { data: 'role', name: 'Role', defaultContent: '-', className: 'text-left'},
                { data: 'status', name: 'Status', defaultContent: '-', className: 'text-left'},
                { data: 'action', name: 'Action', orderable: false },
            ]
        });

        $('#create').click(function () {
            $('#form-active').show()
            $('#form-password').find("input[type=password]").attr('placeholder', '')
            showCreateModal ('Create New User', inputFormId, actionUrl);
        });

        datatableObject.on('click', '.editBtn', function () {
            $('#modalTitle').html("Edit Jurnal");
            $(inputFormId).trigger("reset");

            let tr = $(this).closest('tr');
            let data = datatableObject.row(tr).data();
            $(inputFormId).attr('action', actionUrl + '/' + data.id);

            $('<input>').attr({
                type: 'hidden',
                name: '_method',
                value: 'patch'
            }).prependTo('#inputForm');

            $(inputFormId).find('#email').val(data.email);
            $(inputFormId).find('#name').val(data.name);
            // $(inputFormId).find('#password').val(data.password);
            $(inputFormId).find('#form-password').find("input[type=password]").attr('placeholder', 'kosongi jika tidak memperbarui password')

            {{--let idSelf = {!! auth()->user()->id !!};--}}
            // if (data.role == 'Admin')
            //     $('#form-active').hide()
            $(".role").val(data.role).trigger('change');
            if (data.status == '<small class="label label-success">active</small>') {
                $(inputFormId).find('#status').prop('checked', true);
            }
            else {
                $(inputFormId).find('#status').prop('checked', false);
            }

            $('#saveBtn').val("edit");
            $('[class^="invalid-feedback-"]').html('');  // clearing validation
            $('#inputModal').modal('show');
        });

        $(inputFormId).on('submit', function (event) {
            submitButtonProcess (tableId, inputFormId);
        });

        deleteButtonProcess (datatableObject, tableId, actionUrl);

        $('#fpassword').pwstrength({
            ui: { showVerdictsInsideProgressBar: true }
        });
    });
</script>
@endpush
