@extends('layouts.coreui.master')
@section('title', 'Reservations')
@section('content')
    @include('layouts.status')
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header @if($statusStr == 'Open') bg-success @elseif($statusStr == 'Closed') bg-danger @elseif($statusStr == 'All') bg-primary @endif">
                {{ $statusStr }} Reservations
                <ul class="stats list-inline pull-right">
                    @if($statusStr == 'All')
                        <li class="status status-all list-inline-item" role="presentation">
                            <a class="btn btn-outline btn-outline-primary" href="{{ url('librarian/reservations/all') }}">
                                All <span class="badge badge-light count">{{ $allCount }}</span>
                            </a>
                        </li>
                    @else
                        <li class="status status-all list-inline-item" role="presentation">
                            <a class="btn btn-primary" href="{{ url('librarian/reservations/all') }}">
                                All <span class="badge badge-light count">{{ $allCount }}</span>
                            </a>
                        </li>
                    @endif
                    @if($statusStr == 'Open')
                        <li class="status status-open list-inline-item" role="presentation">
                            <a class="btn btn-outline btn-outline-success" href="{{ url('librarian/reservations/open') }}">
                                Open <span class="badge badge-light count">{{ $openCount }}</span>
                            </a>
                        </li>
                    @else
                        <li class="status status-open list-inline-item" role="presentation">
                            <a class="btn btn-success" href="{{ url('librarian/reservations/open') }}">
                                Open <span class="badge badge-light count">{{ $openCount }}</span>
                            </a>
                        </li>
                    @endif
                    @if($statusStr == 'Closed')
                        <li class="status status-closed list-inline-item" role="presentation">
                            <a class="btn btn-outline btn-outline-danger" href="{{ url('librarian/reservations/closed') }}">
                                Closed <span class="badge badge-light count">{{ $closedCount }}</span>
                            </a>
                        </li>
                    @else
                        <li class="status status-closed list-inline-item" role="presentation">
                            <a class="btn btn-danger" href="{{ url('librarian/reservations/closed') }}">
                                Closed <span class="badge badge-light count">{{ $closedCount }}</span>
                            </a>
                        </li>
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
                                <th>Volunteer Phone</th>
                                <th>Barcode</th>
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
        $(function () {
            var url = '{{ url("librarian/datatables/reservations/all") }}';
            var oTable = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                saveState: true,
                pageLength: '50',
                ajax: {
                    url: url
                },
                columns: [
                    {data: 'reservation_id', name: 'reservation_id'},
                    {data: 'volunteer_name', name: 'volunteer_name'},
                    {data: 'volunteer_email', name: 'volunteer_email'},
                    {data: 'volunteer_phone', name: 'volunteer_phone'},
                    {data: 'barcode', name: 'barcode'},
                    {data: 'open_date', name: 'open_date', searchable: false},
                    {data: 'close_date', name: 'close_date', searchable: false},
                    {data: 'action', name: 'action', className: 'print-hide', searchable: false},
                ],
            });
        });
    </script>
@elseif($statusStr == 'Open')
    <script type="text/javascript">
        $(function () {
            var url = '{{ url("librarian/datatables/reservations/open") }}';
            var oTable = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                saveState: true,
                pageLength: '50',
                ajax: {
                    url: url
                },
                columns: [
                    {data: 'reservation_id', name: 'reservation_id'},
                    {data: 'volunteer_name', name: 'volunteer_name'},
                    {data: 'volunteer_email', name: 'volunteer_email'},
                    {data: 'volunteer_phone', name: 'volunteer_phone'},
                    {data: 'barcode', name: 'barcode'},
                    {data: 'open_date', name: 'open_date', searchable: false},
                    {data: 'action', name: 'action', className: 'print-hide', searchable: false},
                ],
            });
        });
    </script>
@elseif($statusStr == 'Closed')
    <script type="text/javascript">
        $(function () {
            var url = '{{ url("librarian/datatables/reservations/closed") }}';
            var oTable = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                saveState: true,
                pageLength: '50',
                ajax: {
                    url: url
                },
                columns: [
                    {data: 'reservation_id', name: 'reservation_id'},
                    {data: 'volunteer_name', name: 'volunteer_name'},
                    {data: 'volunteer_email', name: 'volunteer_email'},
                    {data: 'volunteer_phone', name: 'volunteer_phone'},
                    {data: 'barcode', name: 'barcode'},
                    {data: 'open_date', name: 'open_date', searchable: false},
                    {data: 'close_date', name: 'close_date', searchable: false},
                    {data: 'action', name: 'action', className: 'print-hide', searchable: false},
                ],
            });
        });
    </script>
@endif
@endpush