@extends('layouts.coreui.master')
@section('title', 'Libraries')
@section('content')
    @include('layouts.status')
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                Libraries
            </div>
            <div class="card-body">
                <table id="datatable" class="table table-bordered table-striped table-hover display dt-responsive" width="100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Library Name</th>
                                <th>County</th>
                                <th>Region</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    $(function() {
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            pageLength: '50',
            ajax: '{{ url("admin/datatables/libraries-data") }}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'library_name', name: 'library_name'},
                {data: 'county', name: 'county'},
                {data: 'region', name: 'region'},
                {data: 'action', name: 'action', className: 'print-hide', searchable: false},
            ],
            initComplete: function () {
                $.each($.fn.dataTable.tables(true), function () {
                    $(this).DataTable()
                        .columns.adjust()
                        .responsive.recalc();
                });
            }
        });
    });
</script>
@endpush