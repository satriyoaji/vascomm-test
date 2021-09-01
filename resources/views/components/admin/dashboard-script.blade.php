@include('components.toast.script-generate')
@include('components.crud-form.basic-script-submit')
@push('footer-scripts')
    <script>
        $(document).ready(function () {
            var actionUrl = '/home';
            var tableId = '#supervisor-point-table';
            var inputFormId = '#supervisor-point-table';

            var datatableObject = $(tableId).DataTable({
                pageLength: 25,
                processing: true,
                serverSide: false,
                searchDelay: 1000,
                language: {
                    emptyTable: "Belum ada supervisor yang melengkapi data"
                },
                ajax: {
                    url: "{{ route('home') }}",
                },
                columns: [
                    { data: 'detail_supervisor.full_name', name: 'Nama', defaultContent: '-', className: 'text-left'},
                    { data: 'email', name: 'Email', defaultContent: '-', className: 'text-left'},
                    { data: 'detail_supervisor.number_phone', name: 'No. Handphone', defaultContent: '-', className: 'text-left'},
                    { data: 'detail_supervisor.address', name: 'Alamat', defaultContent: '-', className: 'text-left'},
                    { data: 'provinsi', name: 'Provinsi', defaultContent: '-', className: 'text-left'},
                    { data: 'detail_supervisor.point', name: 'Point', defaultContent: 0, className: 'text-left' },
                    { data: 'total_supervisi', name: 'Total Supervisi', defaultContent: '-', className: 'text-left' },
                    // { data: 'action', name: 'Action', orderable: false },
                ]
            });

            $('#create').click(function () {
                // showCreateModal ('Create New Master Jurnal', inputFormId, actionUrl);
            });

            $(inputFormId).on('submit', function (event) {
                // submitButtonProcess (tableId, inputFormId);

            });

        });
    </script>
@endpush
