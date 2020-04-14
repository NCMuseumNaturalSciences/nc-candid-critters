@extends('layouts.coreui.master')
@section('title', 'Search Signups')
@section('content')
    @include('layouts.status')
    <div class="animated fadeIn">
        <div class="card card-datatable" id="card-datatable">
            <div class="card-header">
                  <h3 class="card-title float-left"><span class="type-title">{{ $title }}</span> Signups</h3>
                    <div class="float-right form-inline">
                        <div class="form-group">
                            <label class="inline-label" for="signup_type">Activation Type</label>
                            <select id="signupType" class="form-control form-control-sm">
                                <option value=""></option>
                                <option value="1">All</option>
                                <option value="2">Unactivated</option>
                                <option value="3">Activated</option>
                            </select>
                        </div>
                    </div>
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
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="responsive-table" class="table-responsive-sm">
                    <table id="datatable" class="table table-bordered table-striped table-hover">
                        @if($type == 1)
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
                        @elseif($type == 2)
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
                        @elseif($type == 3)
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
                        @endif
                    </table>
                </div>
                <div id="overlay" class="overlay">
                    <div id="cssload-pgloading">
                        <div class="cssload-loadingwrap">
                            <ul class="cssload-bokeh">
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>

        .training-btn-wrapper {
            margin-left: 15px;
            border-left: 2px solid #DCDCDC;
            padding: 0 0 0 15px;
            display: inline-block;
        }
        .training-btn-wrapper .form-group {
            padding: 0;
        }
        .card-header-form {
            font-size: 16px;
            width: 100%;
            margin-top: 6px;
            background: #FFFFFF;
            padding: 15px 60px 15px 15px;
        }
        .btn-col {
            padding-top: 16px;
        }
        #form-wrapper form,
        #form-wrapper form label,
        #form-wrapper .form-group {
            display: inline-block;
        }
        #filter-form label {
            font-size: 16px;
        }
        #overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 102;
            background: rgba(50,50,50,0.5);
        }


        .dt-buttons.btn-group button {
            margin-right: 10px;
            font-size: 10px;
            padding: .4rem .4rem;
        }
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
        function createTable(typeVal) {
            var selected = [];
            var url;
            console.log(typeVal);
            $("span.type-title").empty();
            if(typeVal == 1) {
               url = '{{ url("admin/datatables/signups-data") }}';
               $('.card-header').css('background-color', '#f0f3f5');
                $("span.type-title").html('All');
            }
            else if(typeVal == 2) {
                url = '{{ url("admin/datatables/unactivated-signups-data") }}';
                $('.card-header').css('background-color', '#6D0278');
                $(".card-header h3").css('color','#FFFFFF');
                $(".card-header label.inline-label").css('color','#FFFFFF');
                $("span.type-title").html('Unactivated');
            }
            else if(typeVal == 3) {
                url = '{{ url("admin/datatables/activated-signups-data") }}';
                $('.card-header').css('background-color', '#00813F');
                $(".card-header h3").css('color','#FFFFFF');
                $(".card-header label.inline-label").css('color','#FFFFFF');
                $("span.type-title").html('Activated');
            }
            else {
                url = '{{ url("admin/datatables/signups-data") }}';
                $('.card-header').css('background-color', '#f0f3f5');
                $("span.type-title").html('All');
            }
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
                    {data: 'training', name: 'training_status_id', width: '10%'},
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


            $('#filter-form').on('submit', function (e) {
                console.log("searching");
                oTable.draw();
                e.preventDefault();
            });
        };
        $("#signupType").change(function () {
            var typeVal;
            typeVal = $("#signupType").val();
            createTable(typeVal);
        });
        createTable();
        $('#signupType option[value="1"]').attr("selected",true);
</script>
@endpush