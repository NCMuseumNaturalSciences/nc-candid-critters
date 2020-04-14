@extends('layouts.coreui.master')
@section('title', 'Map Selections')
@section('content')
    @include('layouts.status')
    <div class="animated fadeIn">
        <div class="card card-datatable" id="card-datatable">
            <div class="card-header">
                <h3 class="card-title">Map Selections</h3>
                <div class="card-header-form form-inline row justify-content-end" id="form-wrapper">
                    <div class="col-lg-8 col-md-8 col-sm-12">
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
                                <label for="deployment_yn">Deployment Created</label>
                                <select class="form-control form-control-sm" name="deployment_yn">
                                    <option value=""></option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </div>
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-primary btn-sm">FILTER</button>
                                <button type="button" id="btnRefresh" class="btn btn-primary btn-sm">REFRESH</button>
                            </span>
                        </form>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 float-right">
                        <div class="form-right inline">
                            <button type="button" class="btn btn-sm btn-success float-right" id="createDeployments">Create Deployments</button>
<!--
                            <div class="form-group select-group">
                                <label for="county">County</label>
                                <select class="form-control form-control-sm" name="county" id="countyFilter">
                                    @foreach($counties as $c)
                                        <option value="{{ $c }}">{{ $c }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                        -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body filter-body">
                <div id="responsive-table" class="table-responsive-sm">
                    <table id="datatable" class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Deployment</th>
                            <th>County</th>
                            <th>Lat</th>
                            <th>Long</th>
                            <th>Deployment?</th>
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
            var oTable = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                saveState: true,
                lengthChange: false,
                pageLength: '50',
                dom: 'ilfrtlip',
                order: [[ 1, 'desc' ]],
                ajax: {
                    url: '{{ url("admin/datatables/map-selections-data") }}',
                    data: function (d) {
                        d.deployment_yn = $('select[name=deployment_yn]').val();
                        d.uploader_type = $('select[name=uploader_type]').val();
//                        d.borrower_type = $('select[name=borrower_type]').val();
                    },
                },
                columns: [
                    {data: 'created_at', name: 'site_descriptions.created_at', searchable: false},
                    {data: 'full_name', name: 'full_name', sortable: true},
                    {data: 'email', name: 'email',  sortable: true},
                    {data: 'deployment_name', name: 'deployment_name'},
                    {data: 'county', name: 'site_descriptions.county'},
                    {data: 'acf_lat', name: 'acf_lat', sortable: false, searchable: false},
                    {data: 'acf_long', name: 'acf_long', sortable: false, searchable: false},
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
            $('#createDeployments').click(function () {
                selected = [];
                $("#datatable tbody tr").each(function () {
                    var data = oTable.row(this).data();
                    if ($(this).hasClass('selected')) {
                        selected.push(data.id);
                    }
                });
                console.log(selected);
                var geturl = '{{ url("api/v1/deployments/create") }}';
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

            $('#filter-form').on('submit', function (e) {
                console.log("filtering");
                var uploader_type = $('select[name=uploader_type]').val();
                var deployment_yn = $('select[name=deployment_yn]').val();

                oTable.draw();
                e.preventDefault();
            });
            $("#btnRefresh").on('click',function() {
                console.log('Refresh');
                $('select[name=uploader_type]').prop('selectedIndex',0);
                $('select[name=deployment_yn]').prop('selectedIndex',0);
                oTable.draw();
                e.preventDefault();
            });
        };


        createTable();
    </script>
@endpush