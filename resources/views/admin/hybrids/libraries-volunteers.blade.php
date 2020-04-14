@extends('layouts.coreui.master')
@section('title', 'Volunteer Assignments')
@section('content')
    @include('layouts.status')
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                Volunteer Library Assignments<br>
                <p class="text-muted">Volunteers Assigned to one or more Libraries</p>
            </div>
            <div class="card-body">
                <div id="responsive-table" class="table-responsive-sm">
                    <table id="datatable" class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Type</th>
                            <th>Library</th>
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
                pageLength: '50',
                ajax: '{{ url("admin/datatables/libraries-volunteers-data") }}',
                columns: [
                    {data: 'full_name', name: 'full_name'},
                    {data: 'email', name: 'email'},
                    {data: 'volunteer_type', name: 'volunteer_type'},
                    {data: 'library_name', name: 'libraries.library_name'},
                    {data: 'action', name: 'action', className: 'action-col print-hide', searchable: false},
                ],
            });
        });
    </script>
@endpush