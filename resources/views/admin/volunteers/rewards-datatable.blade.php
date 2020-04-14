@extends('layouts.coreui.master')
@section('title', 'Volunteer Rewards')
@section('content')
    @include('layouts.status')
    <div class="animated fadeIn">
        <div class="card card-datatable" id="card-datatable">
            <div class="card-header">
                <h3 class="card-title">Volunteer Rewards</h3>
                <div class="card-header-form form-inline row" id="form-wrapper">
                    <div class="col-md-12 col-sm-12">
                        <form method="POST" id="filter-form" class="form-inline datatable-filter-form" role="form">
                            <div class="form-group select-group">
                                <label for="koozie_form_yn">Koozie Form Sent</label>
                                <select class="form-control form-control-sm" name="koozie_form_yn">
                                    <option value=""></option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                            <div class="form-group select-group">
                                <label for="tshirt_form_yn">T-Shirt Form Sent</label>
                                <select class="form-control form-control-sm" name="tshirt_form_yn">
                                    <option value=""></option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-primary btn-sm">FILTER</button>
                                <button type="refresh" class="btn btn-primary btn-sm" id="btnRefresh" >REFRESH</button>
                            </span>
                        </form>
                        <div class="form-inline float-lg-right float-md-right">
                            <span class="">
                                <h5 class="btn-group-label inline-label">Toggles</h5>
                                <button type="button" class="btn btn-sm btn-success" id="tshirtSent">T-Shirt</button>
                                <button type="button" class="btn btn-sm btn-success" id="tshirtFormSent">T-Shirt Form</button>
                                <button type="button" class="btn btn-sm btn-success" id="koozieSent">Koozie</button>
                                <button type="button" class="btn btn-sm btn-success" id="koozieFormSent">Koozie Form</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="filterInfo"></div>
                <div id="responsive-table" class="table-responsive-sm">
                    <table id="datatable" class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Deployments</th>
                            <th>Koozie Form</th>
                            <th>Koozie</th>
                            <th>T-Shirt Form</th>
                            <th>T-Shirt</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <style>
        h5.inline-label {
            display: inline;
        }

    </style>
@endsection
@push('scripts')
    <script>
        $("#datatable:has(td)").mouseover(function (e) {
            $(this).css("cursor", "pointer");
        });

        jQuery.fn.dataTableExt.oSort['checked-in-asc']  = function(a,b) {
            var a_sort = parseInt($(a).data("sort"));
            var b_sort =  parseInt($(b).data("sort"));
            return ((a_sort < b_sort) ? -1 : ((a_sort > b_sort) ?  1 : 0));
        };

        jQuery.fn.dataTableExt.oSort['checked-in-desc'] = function(a,b) {
            var a_sort = parseInt($(a).data("sort"));
            var b_sort =  parseInt($(b).data("sort"));
            return ((a_sort < b_sort) ?  1 : ((a_sort > b_sort) ? -1 : 0));
        };
        function createTable() {
            var selected = [];
            var url = '{{ url("admin/datatables/volunteers/rewards") }}';
            oTable = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                saveState: true,
                lengthChange: false,
                pageLength: '50',
                dom: 'ilrtlip',
                destroy: true,
                ajax: {
                    url: url,
                    data: function (d) {
                        d.tshirt_yn = $('select[name=tshirt_form_yn]').val();
                        d.koozie_yn = $('select[name=koozie_form_yn]').val();
//                        d.volunteer_name = $('input[name=volunteer_name]').val();
                    },
                },
                columns: [
                    {data: 'first_name', name: 'volunteers.first_name', searchable: true},
                    {data: 'last_name', name: 'volunteers.last_name', searchable: true},
                    {data: 'email', name: 'email', searchable: true},
                    {data: 'deployment_count', name: 'deployment_count', searchable: false},
                    {data: 'koozie_form',
                        name: 'koozie_form_sent_yn',
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
                    {data: 'koozie',
                        name: 'koozie_yn',
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
                    {data: 'tshirt_form',
                        name: 'tshirt_form_sent_yn',
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
                    {data: 'tshirt',
                        name: 'tshirt_sent_yn',
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
					this.api().columns().every( function () {
						var column = this;
						var select = $('<select><option value=""></option></select>')
							.appendTo( $(column.footer()).empty() )
							.on( 'change', function () {
								var val = $.fn.dataTable.util.escapeRegex(
									$(this).val()
								);
								column
									.search( val ? '^'+val+'$' : '', true, false )
									.draw();
							});
							column.data().unique().sort().each( function ( d, j ) {
								select.append( '<option value="'+d+'">'+d+'</option>' )
							});
            		});
                }
            });
            $('#koozieFormSent').click(function () {
                selected = [];
                $("#datatable tbody tr").each(function () {
                    var data = oTable.row(this).data();
                    console.log(data.id);
                    if ($(this).hasClass('selected')) {
                        selected.push(data.id);
                    }
                });
                console.log(selected);
                var geturl = '{{ url("api/v1/volunteers/rewards/koozie-form/sent") }}';
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
            $('#koozieSent').click(function () {
                selected = [];
                $("#datatable tbody tr").each(function () {
                    var data = oTable.row(this).data();
                    console.log(data.id);
                    if ($(this).hasClass('selected')) {
                        selected.push(data.id);
                    }
                });
                console.log(selected);
                var geturl = '{{ url("api/v1/volunteers/rewards/koozie/sent") }}';
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
            $('#tshirtFormSent').click(function () {
                selected = [];
                $("#datatable tbody tr").each(function () {
                    var data = oTable.row(this).data();
                    if ($(this).hasClass('selected')) {
                        selected.push(data.id);
                    }
                });
                var geturl = '{{ url("api/v1/volunteers/rewards/tshirt-form/sent") }}';
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
            $('#tshirtSent').click(function () {
                selected = [];
                $("#datatable tbody tr").each(function () {
                    var data = oTable.row(this).data();
                    if ($(this).hasClass('selected')) {
                        selected.push(data.id);
                    }
                });
                var geturl = '{{ url("api/v1/volunteers/rewards/tshirt/sent") }}';
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
                oTable.draw();
                e.preventDefault();
            });
            $("#btnRefresh").on('click',function(e) {
                $('select[name=koozie_form_yn]').val($("select[name=koozie_form_yn] option:first").val());
                $('select[name=tshirt_form_yn]').val($("select[name=tshirt_form_yn] option:first").val());
                oTable.draw();
                e.preventDefault();
            });
        };
        createTable();
    </script>
@endpush