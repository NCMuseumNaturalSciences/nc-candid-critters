@extends('layouts.coreui.master')
@section('title', 'Volunteers')
@section('content')
    @include('layouts.status')
    <div class="animated fadeIn">
        <div class="card card-datatable" id="card-datatable">
            <div class="card-header">
                <h3 class="card-title">Volunteers</h3>
                <div class="card-header-form form-inline row" id="form-wrapper">
                    <div class="col-md-12 col-sm-12">
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
                                <select class="form-control form-control-sm" name="borrower_type" id="borrower_type">
                                    <option value="0"></option>
                                    <option value="1">Borrower</option>
                                    <option value="2">BYO</option>
                                </select>
                            </div>
                            <div class="form-group select-group">
                                <label for="library_yn">Assigned Library</label>
                                <select class="form-control form-control-sm" name="library_yn" id="library_yn">
                                    <option value="0"></option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </div>
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-primary btn-sm">FILTER</button>
                                <button type="refresh" class="btn btn-primary btn-sm" id="btnRefresh">REFRESH</button>
                            </span>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="responsive-table" class="table-responsive-sm">
                    <table id="datatable" class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Created</th>
                            <th>Activation</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Uploader</th>
                            <th>Borrower</th>
                            <th>Assigned Library?</th>
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
        function createTable() {
            var oTable = $('#datatable').DataTable({
                destroy: true,
                pageLength: '50',
                processing: true,
                serverSide: true,
                saveState: true,
                ajax: {
                    url: '{{ url("admin/datatables/volunteers") }}',
                    data: function (d) {
                        d.uploader_type = $('select[name=uploader_type]').val();
                        d.borrower_type = $('select[name=borrower_type]').val();
                        d.library_yn = $('select[name=library_yn]').val();
                    },
                },
                columns: [
                    {data: 'created_at', name:'created_at',searchable: false},
                    {data: 'activation_date', name:'activation_date',searchable: false},
                    {data: 'full_name', name: 'full_name', sortable: true},
                    {data: 'email', name: 'email', sortable: true},
                    {data: 'utype', name: 'acf_uploader_yn'},
                    {data: 'btype', name: 'acf_borrower_yn'},
                    {data: 'assignment_yn', name: 'assignmentId', sortable: true, searchable: false},
                    {data: 'action', name: 'action', className: 'print-hide', searchable: false},
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
                $('select[name=library_yn]').prop('selectedIndex',0);
                oTable.draw();
                e.preventDefault();
            });
        };
        createTable();
    </script>
@endpush