@extends('layouts.coreui.master')
@section('title', 'Manage Library Volunteers')
@section('content')
    @include('layouts.status')
    {!! Form::hidden('library_id', $library->id, ['id' => 'library-id']) !!}
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                Manage Library Volunteers | {{ $library->library_name }}
            </div>
            <div class="card-body">
                <div id="responsive-table" class="table-responsive-sm">
                    <table id="libraries-table" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Volunteer Name</th>
                                <th>Email</th>
                                <th>Date Assigned</th>
                                <th>Library Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="button-footer">
                    <a href="{{ url('/admin/libraries/' . $library->id . '/show') }}" class="btn btn-success">View Library</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(function() {
            $('#libraries-table').DataTable({
                processing: true,
                serverSide: true,
                pageLength: '50',
                ajax: '{{ url("admin/datatables/libraries/" . $library->id . "/assignments") }}',
                columns: [
                    {data: 'full_name', name: 'full_name'},
                    {data: 'email', name: 'email'},
                    {data: 'date_assigned', name: 'date_assigned', sortable: false, searchable: false},
                    {data: 'library_name', name: 'library_name'},
                    {data: 'action', name: 'action', className: 'print-hide', searchable: false},
                ],
            });
        });
    </script>
@endpush
