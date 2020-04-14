@extends('layouts.coreui.master')
@section('title', 'Deployments')
@section('content')
    @include('layouts.status')
    <div class="animated fadeIn">
        <div class="card card-datatable" id="card-datatable">
            <div class="card-header">
                <h3 class="card-title">Deployments</h3>
                <div class="card-header-form form-inline row" id="form-wrapper">
                    <div class="col-md-12 col-sm-12">
                        <form method="POST" id="filter-form" class="form-inline datatable-filter-form" role="form">
                            <div class="form-group select-group">
                                <label for="status">Filter Status</label>
                                {!! Form::select('status', $statusSet, null, ['class'=> 'form-control-sm']) !!}
                                <button type="submit" class="btn btn-sm btn-primary inline-button">SEARCH</button>
                            </div>
                        </form>
                        <div class="form-inline float-lg-right float-md-right">
                            <div class="form-group select-group">
                                <label for="status">Set Upload Status</label>
                                {!! Form::select('newStatus', $setStatusSet, null, ['class'=> 'form-control-sm', 'id' => 'newStatus']) !!}
                                <button type="button" class="btn btn-sm btn-success inline-button" id="setStatus">SET</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="datatable" class="table table-bordered table-striped table-hover display dt-responsive" width="100%">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Uploader</th>
                            <th>Email</th>
                            <th>Upload Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
<style>
    button.inline-button {
        margin: 0;
    }
    .form-group label {
        font-size: 12px;
    }
    label.label-inline {
    display: inline;
    }
</style>
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
                processing: true,
                serverSide: true,
                pageLength: '50',
                responsive: true,
                ajax: {
                    url: '{{ url("admin/datatables/deployments") }}',
                    data: function (d) {
                        d.status = $('select[name=status]').val();
                    },
                },
                columns: [
                    {data: 'created_at', name: 'deployments.created_at', searchable: false},
                    {data: 'deployment_name', name: 'deployment_name'},
                    {data: 'acf_lat', name: 'site_descriptions.acf_lat'},
                    {data: 'acf_long', name: 'site_descriptions.acf_long'},
                    {data: 'utype', name: 'acf_uploader_yn', searchable: false},
                    {data: 'volunteer_email', name: 'volunteers.email'},
                    {data: 'upload_status', name: 'deployments.upload_status', searchable: false},
                    {data: 'action', name: 'action', className: 'print-hide', searchable: false},
                ],
                select: {
                    style: 'multi',
                },
                initComplete: function () {
                    $.each($.fn.dataTable.tables(true), function(){
                        $(this).DataTable()
                            .columns.adjust()
                            .responsive.recalc();
                    });
                    $('#datatable').on('click', 'tbody tr', function () {
                        if ($(this).hasClass('selected')) {
                            $(this).removeClass('selected');
                        }
                        else {
                            $(this).addClass('selected');
                        }
                    });
                }
            });
            $('.datatable_filter input')
                .off()
                .on('keyup', function() {
                    console.log('keyup filter');
                    oTable.search(this.value.trim(), false, false).draw();
                });
            $('#setStatus').click(function () {
                selected = [];
                var newStatus = $("#newStatus").val();
                $("#datatable tbody tr").each(function () {
                    var data = oTable.row(this).data();
                    if ($(this).hasClass('selected')) {
                        selected.push(data.id);
                    }
                });
                console.log(selected);
                console.log(newStatus);
                var geturl = '{{ url("api/v1/deployments/set-status") }}';
                $.ajax({
                    type: 'get',
                    dataType: 'json',
                    url: geturl,
                    data: {
                        status: $("#newStatus").val(),
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