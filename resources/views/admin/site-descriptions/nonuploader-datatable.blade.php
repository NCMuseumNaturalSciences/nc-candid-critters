@extends('layouts.coreui.master')
@section('title', 'Nonuploader Site Descriptions')
@section('content')
    @include('layouts.status')
    <div class="animated fadeIn">
        <div class="card card-datatable" id="card-datatable">
            <div class="card-header">
                <h3 class="card-title">Non-uploader Site Descriptions</h3>
                <div class="card-header-form form-inline row" id="form-wrapper">
                    <div class="col-lg-8 col-md-8 col-sm-12">
                        <form method="POST" id="filter-form" class="form-inline datatable-filter-form" role="form">
                            <div class="form-group select-group">
                                <label for="borrower_type">Borrower Type</label>
                                <select class="form-control form-control-sm" name="borrower_type">
                                    <option value=""></option>
                                    <option value="1">Borrower</option>
                                    <option value="2">BYO</option>
                                </select>
                            </div>
                            <div class="form-group select-group">
                                <label for="deployment_yn">Deployment Created</label>
                                <select class="form-control form-control-sm" name="deployment_yn">
                                    <option value=""></option>
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
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="form-right inline">
                            <button type="button" class="btn btn-sm btn-success float-right" id="toggleEmammal"><i class="far fa-sliders-h-square"></i> Toggle eMammal</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="responsive-table" class="table-responsive-sm">
                    <table id="datatable" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Date</th></thj>
                                <th>Deployment Name</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Lat</th>
                                <th>Lon</th>
                                <th>County</th>
                                <th>Deployment?</th>
                                <th>eMammal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')<script type="text/javascript">
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
            var dturl = '{{ url("admin/datatables/nonuploader/site-descriptions-data") }}';
            var oTable = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                saveState: true,
                lengthChange: false,
                pageLength: '50',
                dom: 'ilfrtlip',
                ajax: {
                    url: dturl,
                    data: function (d) {
                        d.deployment_yn = $('select[name=deployment_yn]').val();
                        d.borrower_type = $('select[name=borrower_type]').val();
                    },
                },
                columns: [
                    {data: 'submission_date', name: 'site_descriptions.created_at', searchable: false},
                    {data: 'deployment_name', name: 'deployment_name'},
                    {data: 'full_name', name: 'full_name', sortable: true},
                    {data: 'email', name: 'email',  sortable: true},
                    {data: 'acf_lat', name: 'acf_lat', width: '6%', sortable: false, searchable: false},
                    {data: 'acf_long', name: 'acf_long', width: '6%', sortable: false, searchable: false},
                    {data: 'county', name: 'site_descriptions.county'},
                    {data: 'deployment_status',
                        name: 'site_descriptions.deployment_yn',
                        createdCell: function ( cell, cellData ) {
                            if (cellData == "Yes") {
                                $(cell).addClass("success-cell");
                            }
                            else if (cellData == "No") {
                                $(cell).addClass("danger-cell");
                            }
                        },
                        searchable: false
                    },
                    {data: 'emammal_yn',
                        name: 'site_descriptions.emammal_created_yn',
                        createdCell: function ( cell, cellData ) {
                            if (cellData == "Yes") {
                                $(cell).addClass("success-cell");
                            }
                            else if (cellData == "No") {
                                $(cell).addClass("danger-cell");
                            }
                       },
                        searchable: false
                    },
                    {data: 'action', name: 'action', className: 'print-hide', searchable: false, sortable: false},
                ],
                select: {
                    style: 'multi',
                },
                initComplete: function () {
                    $('#datatable').on('click', 'tbody tr', function () {
                        if ($(this).hasClass('selected')) {
                            $(this).removeClass('selected');
                        } else {
                            $(this).addClass('selected');
                        }
                    });
                }
            });
            $('#toggleEmammal').click(function () {
                selected = [];
                $("#datatable tbody tr").each(function () {
                    var data = oTable.row(this).data();
                    if ($(this).hasClass('selected')) {
                        selected.push(data.id);
                    }
                });
                console.log(selected);
                var geturl = '{{ url("api/v1/site-descriptions/toggle/emammal") }}';
                $.ajax({
                    type: 'get',
                    dataType: 'json',
                    url: geturl,
                    data: {
                        selected: selected
                    },
                    success: function (data) {
                        console.log(data);
                        oTable.draw();
                    },
                    error: function (xhr, textStatus, thrownError) {
                        console.log(xhr.toString());
                        console.log(textStatus);
                        alert(xhr.status);
                        alert(thrownError);
                    }
                });
            });
            $('.datatable_filter input')
                .off()
                .on('keyup', function() {
                    console.log('keyup filter');
                    oTable.search(this.value.trim(), false, false).draw();
                });
            $('#filter-form').on('submit', function (e) {
                console.log("searching");
                oTable.draw();
                e.preventDefault();
            });
            $("#btnRefresh").on('click',function(e) {
                $('select[name=borrower_type]').prop('selectedIndex',0);
                $('select[name=deployment_yn]').prop('selectedIndex',0);
                oTable.draw();
                e.preventDefault();
            });
        };
        createTable();
    </script>
@endpush