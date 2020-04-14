@extends('layouts.coreui.master')
@section('title', 'Acceptable Camera Models')
@section('content')
    @include('layouts.status')
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                Acceptable Camera Models
            </div>
            <div class="card-body">
                <div id="responsive-table" class="table-responsive-sm">
                    <table id="cameras-table" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Make</th>
                                <th>Model</th>
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
        $('#cameras-table').DataTable({
            processing: true,
            serverSide: true,
            pageLength: '50',
            ajax: '{{ url("admin/datatables/cameras-data") }}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'make', name: 'make'},
                {data: 'model', name: 'model'},
                {data: 'action', name: 'action', className: 'print-hide', searchable: false},
            ],
        });
    });
</script>
@endpush