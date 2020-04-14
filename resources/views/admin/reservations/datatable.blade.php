@extends('layouts.coreui.master')
@section('title', 'Reservations')
@section('content')
    @include('layouts.status')
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header @if($statusStr == 'Open') bg-success @elseif($statusStr == 'Closed') bg-danger @elseif($statusStr == 'All') bg-primary @endif">
                {{ $statusStr }} Reservations @if($library)- {{ $library_name }} @endif
                <ul class="stats list-inline pull-right">
                    @if(!$library)
                        @if($statusStr == 'All')
                            <li class="status status-all list-inline-item" role="presentation">
                                <a class="btn btn-outline btn-outline-primary" href="{{ url('admin/reservations/all') }}">
                                    All <span class="badge badge-light count">{{ $allCount }}</span>
                                </a>
                            </li>
                        @else
                            <li class="status status-all list-inline-item" role="presentation">
                                <a class="btn btn-primary" href="{{ url('admin/reservations/all') }}">
                                    All <span class="badge badge-light count">{{ $allCount }}</span>
                                </a>
                            </li>
                        @endif
                        @if($statusStr == 'Open')
                            <li class="status status-open list-inline-item" role="presentation">
                                <a class="btn btn-outline btn-outline-success" href="{{ url('admin/reservations/open') }}">
                                    Open <span class="badge badge-light count">{{ $openCount }}</span>
                                </a>
                            </li>
                        @else
                            <li class="status status-open list-inline-item" role="presentation">
                                <a class="btn btn-success" href="{{ url('admin/reservations/open') }}">
                                    Open <span class="badge badge-light count">{{ $openCount }}</span>
                                </a>
                            </li>
                        @endif
                        @if($statusStr == 'Closed')
                            <li class="status status-closed list-inline-item" role="presentation">
                                <a class="btn btn-outline btn-outline-danger" href="{{ url('admin/reservations/closed') }}">
                                    Closed <span class="badge badge-light count">{{ $closedCount }}</span>
                                </a>
                            </li>
                        @else
                            <li class="status status-closed list-inline-item" role="presentation">
                                <a class="btn btn-danger" href="{{ url('admin/reservations/closed') }}">
                                    Closed <span class="badge badge-light count">{{ $closedCount }}</span>
                                </a>
                            </li>
                        @endif
                    @endif
                </ul>
            </div>
            <div class="card-body">
                <div id="responsive-table" class="table-responsive-sm">
                    <table id="datatable" class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Volunteer</th>
                            <th>Volunteer Email</th>
                            <th>@if($library){{ $library->library_name }} @else Volunteer Phone @endif</th>
                            <th>Library</th>
                            <th>Open Date</th>
                            @if($statusStr != 'Open')
                                <th>Close Date</th>
                            @endif
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
    @if($statusStr == 'All')
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
            $(function () {
                var url = '{{ url("admin/datatables/reservations/all") }}';
                var oTable = $('#datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    saveState: true,
                    pageLength: '50',
                    ajax: {
                        url: url
                    },
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'volunteer_name', name: 'volunteer_name'},
                        {data: 'volunteer_email', name: 'volunteers.email'},
                        {data: 'volunteer_phone', name: 'volunteers.telephone'},
                        {data: 'library_name', name: 'libraries.library_name'},
                        {data: 'open_date', name: 'open_date', searchable: false},
                        {data: 'close_date', name: 'close_date', searchable: false},
                        {data: 'action', name: 'action', className: 'print-hide', searchable: false},
                    ],
                });
            });
        </script>
    @elseif($statusStr == 'Open')
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
            $(function () {
                var url = '{{ url("admin/datatables/reservations/open") }}';
                var oTable = $('#datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    saveState: true,
                    pageLength: '50',
                    ajax: {
                        url: url
                    },
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'volunteer_name', name: 'volunteer_name'},
                        {data: 'volunteer_email', name: 'volunteers.email'},
                        {data: 'volunteer_phone', name: 'volunteers.telephone'},
                        {data: 'library_name', name: 'libraries.library_name'},
                        {data: 'open_date', name: 'open_date', searchable: false},
                        {data: 'action', name: 'action', className: 'print-hide', searchable: false},
                    ],
                });
            });
        </script>
    @elseif($statusStr == 'Closed')
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
            $(function () {
                var url = '{{ url("admin/datatables/reservations/closed") }}';
                var oTable = $('#datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    saveState: true,
                    pageLength: '50',
                    ajax: {
                        url: url
                    },
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'volunteer_name', name: 'volunteer_name'},
                        {data: 'volunteer_email', name: 'volunteers.email'},
                        {data: 'volunteer_phone', name: 'volunteers.telephone'},
                        {data: 'library_name', name: 'libraries.library_name'},
                        {data: 'open_date', name: 'open_date', searchable: false},
                        {data: 'close_date', name: 'close_date', searchable: false},
                        {data: 'action', name: 'action', className: 'print-hide', searchable: false},
                    ],
                });
            });
        </script>
    @elseif($statusStr == 'Open' && $library)

        <input type="hidden" value="{{ $library->id }}" name="library_id" class="library_id">
        <input type="hidden" value="0" name="status_id" class="status_id">
        <script type="text/javascript">
            var library = $('.library_id').val();
            var status = $('.status_id').val();
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
            $(function () {
                var url = '{{ url("admin/datatables/reservations/" . status . "/library/" . library) }}';
                var oTable = $('#datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    saveState: true,
                    pageLength: '50',
                    ajax: {
                        url: url
                    },
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'volunteer_name', name: 'volunteer_name'},
                        {data: 'volunteer_email', name: 'volunteers.email'},
                        {data: 'volunteer_phone', name: 'volunteers.telephone'},
                        {data: 'library_name', name: 'libraries.library_name'},
                        {data: 'open_date', name: 'open_date', searchable: false},
                        {data: 'action', name: 'action', className: 'print-hide', searchable: false},
                    ],
                });
            });
        </script>
    @endif
@endpush