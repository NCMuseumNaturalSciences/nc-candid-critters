@extends('layouts.coreui.master')
@section('title', 'Library User Accounts')
@section('content')
    @include('layouts.status')
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                Library User Accounts
            </div>
            <div class="card-body">
                <div id="responsive-table" class="table-responsive-sm">
                    <table id="datatable" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>Name</th>
                                <th>Email</th>
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
                ajax: '{{ url("admin/datatables/libraries-users-data") }}',
                columns: [
                    {data: 'user_id', name: 'user_id'},
                    {data: 'full_name', name: 'full_name'},
                    {data: 'email', name: 'email'},
                    {data: 'library_name', name: 'library_name'},
                    {data: 'action', name: 'action', className: 'print-hide', searchable: false},
                ],
            });
        });
    </script>
@endpush