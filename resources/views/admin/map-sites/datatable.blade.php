@extends('layouts.coreui.master')
@section('title', 'Map Sites')
@section('content')
    @include('layouts.status')
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                Map Sites
            </div>
            <div class="card-body">
                <div id="responsive-table" class="table-responsive-sm">
                    <table id="map-sites-table" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Site Name</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
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
        $('#map-sites-table').DataTable({
            processing: true,
            serverSide: true,
            pageLength: '50',
            ajax: '{{ url("admin/datatables/map-sites") }}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'site_name', name: 'site_name'},
                {data: 'lat', name: 'lat', searchable: false},
                {data: 'lon', name: 'lon',searchable: false},
                {data: 'action', name: 'action', className: 'print-hide', searchable: false},
            ],
        });
    });
</script>
@endpush