@extends('layouts.coreui.master')
@section('title', 'Search Unactivated Signups')
@section('content')
    @include('layouts.status')
    <div class="animated fadeIn">
        <div class="card card-datatable" id="card-datatable">
            <div class="card-header">
                <h3 class="card-title float-left"><span class="type-title">Unactivated</span> Signups</h3>
                <div class="clearfix"></div>
                <div class="card-header-form form-inline row" id="form-wrapper">
                    <div class="col-lg-8 col-md-8 col-sm-12">
                        <form method="POST" id="filter-form" class="form-inline datatable-filter-form" role="form">
                            <div class="form-group select-group">
                                <label for="training_status">Training Status</label>
                                <select class="form-control form-control-sm" name="training_status">
                                    <option value="">All</option>
                                    <option value="3">Completed</option>
                                    <option value="2">Assigned</option>
                                    <option value="1">Unassigned</option>
                                </select>
                            </div>
                            <div class="form-group select-group">
                                <label for="uploader_type">Uploader Type</label>
                                <select class="form-control form-control-sm" name="uploader_type">
                                    <option value=""></option>
                                    <option value="1">Uploader</option>
                                    <option value="2">Non-uploader</option>
                                </select>
                            </div>
                            <div class="form-group btn-group">
                                <input class="btn btn-primary btn-sm center-block" value="Search" type="submit">
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="form-right inline">
                            <button type="button" class="btn btn-sm btn-primary" id="assignTraining">Assign Training</button>
                            <button type="button" class="btn btn-sm btn-primary" id="completedTraining">Training Completed</button>
                            <button type="button" class="btn btn-sm btn-success" id="activateVolunteers">Activate</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="responsive-table" class="table-responsive-sm">
                    <table id="datatable" class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Borrower</th>
                                <th>Uploader</th>
                                <th>Training</th>
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
        $("#datatable:has(td)").mouseover(function (e) {
            $(this).css("cursor", "pointer");
        });
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
            var url = '{{ url("admin/datatables/unactivated-signups-data") }}';
            var selected = [];
            var oTable = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                saveState: true,
                lengthChange: false,
                pageLength: '50',
                dom: 'ilfrtlip',
                ajax: {
                    url: url,
                    data: function (d) {
                        d.training_status = $('select[name=training_status]').val();
                        d.uploader_type = $('select[name=uploader_type]').val();
                    },
                },
                columns: [
                    {data: 'sdate', name: 'signups.created_at', searchable: false},
                    {data: 'pname', name: 'pname', width: '16%'},
                    {data: 'email', name: 'email', width: '16%'},
                    {data: 'btype', name: 'acf_borrower_yn', width: '10%'},
                    {data: 'utype', name: 'acf_uploader_yn', width: '12%'},
                    {data: 'training',
                        name: 'training_status_id',
                        width: '10%',
                        createdCell: function ( cell, cellData ) {
                            if (cellData == "Unassigned") {
                                $(cell).addClass("danger-cell");
                            }
                            else if (cellData == "Assigned") {
                                $(cell).addClass("warning-cell");
                            }
                            else if (cellData == "Completed") {
                                $(cell).addClass("success-cell");
                            }
                            else if(cellData == "Error") {
                                $(cell).addClass("danger-cell");
                            }
                        },
                        searchable: false
                    },
                    {data: 'action', name: 'action', className: 'print-hide', searchable: false},
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
            $('#assignTraining').click(function () {
                selected = [];
                $("#datatable tbody tr").each(function () {
                    var data = oTable.row(this).data();
                    console.log(data.id);
                    if ($(this).hasClass('selected')) {
                        selected.push(data.id);
                    }
                });
                console.log(selected);
                var geturl = '{{ url("api/v1/training/assign") }}';
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
                        alert(xhr.status);
                        alert(thrownError);
                    }
                });

            });
            $('#completedTraining').click(function () {
                selected = [];
                $("#datatable tbody tr").each(function () {
                    var data = oTable.row(this).data();
                    if ($(this).hasClass('selected')) {
                        selected.push(data.id);
                    }
                });
                var geturl = '{{ url("api/v1/training/completed") }}';
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
                        alert(xhr.status);
                        alert(thrownError);
                    }
                });
            });
            $("#activateVolunteers").click(function() {
                selected = [];
                $("#datatable tbody tr").each(function () {
                    var data = oTable.row(this).data();
                    if ($(this).hasClass('selected')) {
                        selected.push(data.id);
                    }
                });
                console.log(selected);
                var geturl = '{{ url("api/v1/volunteers/activate") }}';
                console.log(geturl);
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
                        alert(xhr.status);
                        alert(thrownError);
                    }
                });
            });

            $('#filter-form').on('submit', function (e) {
                console.log("searching");
                oTable.draw();
                e.preventDefault();
            });
        };
        createTable();
    </script>
@endpush