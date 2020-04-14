@extends('layouts.coreui.master')
@section('title', 'Site Descriptions')
@section('content')
    @include('layouts.status')
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Site Descriptions</h3>
                <div class="card-header-form" id="form-wrapper">
                    <form method="POST" id="filter-form" class="form-inline datatable-filter-form" role="form">
                        <div class="form-group select-group">
                            <label for="uploader_type">Uploader Type</label>
                            <select class="form-control form-control-sm" name="uploader_type">
                                <option value=""></option>
                                <option value="1">Uploader</option>
                                <option value="2">Non-uploader</option>
                            </select>
                        </div>
                        <div class="form-group select-group">
                            <label for="borrower_type">Borrower Type</label>
                            <select class="form-control form-control-sm" name="borrower_type">
                                <option value=""></option>
                                <option value="1">Borrower</option>
                                <option value="2">BYO</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">SEARCH</button>
                        <button type="refresh" id="btnRefresh" class="btn btn-primary">REFRESH</button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div id="responsive-table" class="table-responsive-sm">
                    <table id="datatable" class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Deployment Name</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Uploader Type</th>
                            <th>Lat</th>
                            <th>Lon</th>
                            <th>County</th>
                            <th>Deployment Created</th>
                            <th>Deploy Count</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <style>

    </style>
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
            });
            // Add sorting method - use an integer for the sorting
            types.order[ 'moment-'+format+'-pre' ] = function ( d ) {
                return moment( d, format, locale, true ).unix();
            };
        };
        $(function() {
            var oTable = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                saveState: true,
                lengthChange: false,
                pageLength: '50',
                dom: 'Blfrtlip',
                buttons: [
                    {extend: 'copyHtml5', className: 'btn btn-custom-view btn-dt btn-xs'},
                    {extend: 'csvHtml5', className: 'btn btn-custom-view btn-dt btn-xs'},
                    {extend: 'excelHtml5', className: 'btn btn-custom-view btn-dt btn-xs'},
                    {extend: 'pdfHtml5', className: 'btn btn-custom-view btn-dt btn-xs'},
                    {extend: 'print', className: 'btn btn-custom-view btn-dt btn-xs'},
                ],
                ajax: {
                    url: '{{ url("admin/datatables/site-descriptions-data") }}',
                    data: function (d) {
                        d.uploader_type = $('select[name=uploader_type]').val();
                        d.borrower_type = $('select[name=borrower_type]').val();
                    },
                },
                columns: [
                    {data: 'submission_date', name: 'site_descriptions.created_at', searchable: false},
                    {data: 'deployment_name', name: 'deployment_name', searchable: false, width: '15%'},
                    {data: 'full_name', name: 'full_name', sortable: true, width: '15%'},
                    {data: 'email', name: 'email',  sortable: true, width: '15%'},
                    {data: 'utype', name: 'acf_uploader_yn', width: '12%'},
                    {data: 'acf_lat', name: 'acf_lat', width: '6%', sortable: false, searchable: false},
                    {data: 'acf_long', name: 'acf_long', width: '6%', sortable: false, searchable: false},
                    {data: 'county', name: 'site_descriptions.county'},
                    {data: 'deployment_status', name: 'deployment_yn', width: '10%'},
                    {data: 'deployment_count', name: 'deployment_count', width: '3%', searchable: false},
                    {data: 'action', name: 'action', className: 'print-hide', searchable: false, sortable: false},
                ],
            });

            $('#filter-form').on('submit', function (e) {
                console.log("searching");
                oTable.draw();
                e.preventDefault();
            });
            $("#btnRefresh").on('click',function(e) {
                $('select[name=uploader_type]').prop('selectedIndex',0);
                $('select[name=borrower_type]').prop('selectedIndex',0);
                oTable.draw();
                e.preventDefault();
            });
        });
    </script>
@endpush