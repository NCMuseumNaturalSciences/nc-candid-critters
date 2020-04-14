@extends('layouts.coreui.master')
@section('title', 'Search Signups')
@section('content')
    @include('layouts.status')
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                Signups
                <div class="card-header-form" id="form-wrapper">
                    <form method="POST" id="filter-form" class="form-inline datatable-filter-form" role="form">
                        <div class="form-group">
                            <label for="training_status">Training Status</label>
                            <select class="form-control input-sm" name="training_status">
                                <option value="">All</option>
                                <option value="3">Completed</option>
                                <option value="2">Assigned</option>
                                <option value="1">Unassigned</option>
                            </select>
                        </div>
                        <div class="form-group btn-group">
                            <input class="btn btn-primary center-block" value="SEARCH" type="submit">
                        </div>
                    </form>
                    <div class="form-group btn-group btn-col">
                        <button type="button" class="btn btn-primary" id="assignTraining">Assign Training</button>
                    </div>
                    <div class="form-group btn-group btn-col">
                        <button type="button" class="btn btn-primary" id="completedTraining">Training Completed</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="responsive-table" class="table-responsive-sm">
                    <table id="datatable" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th>Training</th>
                                <th>Volunteer Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
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
        #form-wrapper {
            width: 100%;
            margin-top: 6px;
            background: #FFFFFF;
        }
        #form-wrapper form {
            padding: 5px 60px 5px 15px;
        }
        .btn-col {
            padding-top: 16px;
        }
        #form-wrapper form,
        #form-wrapper form label,
        #form-wrapper .form-group {
            display: inline-block;
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
        #datatable tbody tr.selected {
            background-color: rgba(150,150,150,0.4);
        }
        #datatable tbody tr.selected td {
            color: #29363D;
        }
        #datatable tbody tr.selected td a {
            color: #29363D;
        }
    </style>
@endsection
@push('scripts')
<script type="text/javascript">
        $("#datatable:has(td)").mouseover(function (e) {
            $(this).css("cursor", "pointer");
        });
        $(".submission-date").daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear',
                format: 'YYYY-MM-DD',
            },
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            "endDate": moment(),
        });
        $(".submission-date").on('apply.daterangepicker', function (ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD'));
        });
        $('.submission-date').on('cancel.daterangepicker', function (ev, picker) {
            $(this).val('');
        });

        $(function () {
            var url = '{{ url("admin/datatables/signups-data") }}';
            var selected = [];

            var oTable = $('#datatable').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                saveState: true,
                language: {
                    "processing": "Hang on." //add a loading image,simply putting <img src="loader.gif" /> tag.
                },
                ajax: {
                    url: url,
                    data: function (d) {
                        d.training_status = $('select[name=training_status]').val();
                    },
                },
                columns: [
                    {data: 'pname', name: 'pname'},
                    {data: 'email', name: 'email'},
                    {data: 'stype', name: 'stype'},
                    {data: 'training', name: 'training'},
                    {data: 'volunteer', name: 'volunteer'},
                    {data: 'action', name: 'action', className: 'print-hide', searchable: false},
                ],
                select: {
                    style: 'multi',
                },
                initComplete: function (settings, json) {
                    $('#datatable').on('click', 'tbody tr', function() {
                        if ( $(this).hasClass('selected') ) {
                            $(this).removeClass('selected');
                        }
                        else {
                            $(this).addClass('selected');
                        }
                    })
                }
            }).draw();

            $('#assignTraining').click(function () {
                selected = [];
                $("#datatable tbody tr").each(function () {
                    var data = oTable.row(this).data();
                    if( $(this).hasClass('selected') ) {
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
                    if( $(this).hasClass('selected') ) {
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
        });
</script>
@endpush