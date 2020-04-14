@extends('layouts.coreui.master')
@section('title', 'Map Selections')
@section('content')
    @include('layouts.status')
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Map Selections</h3>
            </div>
            <div class="card-body filter-body">
<!--
                <form method="POST" id="search-form" class="form-horizontal datatable-filter-form" role="form">
                    <div class="row">
                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control input-sm" id="siteStatus" name="status">
                                    <option value=""></option>
                                    <option value="Available">Available</option>
                                    <option value="Unavailable">Unavailable</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9">
                            <div class="btn-filter-group">
                                <button type="submit" class="btn btn-primary btn-md">Filter</button>
                            </div>
                        </div>
                    </div>
                </form>
                -->
                <div id="responsive-table" class="table-responsive-sm">
                    <table id="datatable" class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Deployment</th>
                            <th>Submitted</th>
                            <th>Lat</th>
                            <th>Long</th>
                            <th>Status</th>
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
    <script type="text/javascript">
        $.fn.dataTable.moment( 'MM\D\YYYY');
        $.fn.dataTable.moment = function ( format, locale ) {
            var types = $.fn.dataTable.ext.type;

            // Add type detection
            types.detect.unshift( function ( d ) {
                return moment( d, format, locale, true ).isValid() ?
                    'moment-'+format :
                    null;
            } );
            // Add sorting method - use an integer for the sorting
            types.order[ 'moment-'+format+'-pre' ] = function ( d ) {
                return moment( d, format, locale, true ).unix();
            };
        };
        $(function() {
            var url = '{{ url("admin/datatables/map-selections") }}';
            $('#datatable').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                pageLength: '50',
                ajax: {
                    url: url,
                },
                columns: [
                    {data: 'full_name', name: 'full_name'},
                    {data: 'email', name: 'email'},
                    {data: 'deployment_name', name: 'deployment_name'},
                    {data: 'created_at', name: 'created_at', searchable: false},
                    {data: 'lat', name: 'lat', searchable: false},
                    {data: 'long', name: 'long', searchable: false},
                    {data: 'deployment_status', name: 'deployment_status', sortable: false},
                    {data: 'action', name: 'action', className: 'print-hide', searchable: false},
                ],
            });
        });
    </script>
@endpush