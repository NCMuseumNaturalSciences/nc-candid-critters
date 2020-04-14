@extends('layouts.coreui.master')
@section('title', 'Master Inventory')
@section('content')
    @include('layouts.status')
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                Master Inventory
                <div class="form-wrapper float-right">
                    <button type="button" class="btn btn-custom-success btn-xs dt-header-button" data-toggle="modal" data-target="#inventoryModalPost">Add</button>

                    <form method="POST" id="search-form" class="form-inline" role="form">
                        <div class="form-group">
                            <label for="name">Status</label>
                            <select name="status_code" class="form-control form-control-sm">
                                <option value=""></option>
                                @foreach($statuses as $s)
                                    <option value="{{ $s->status_code }}">{{ $s->status_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-xs btn-primary">Filter</button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <table id="datatable" class="table table-bordered table-striped table-hover display dt-responsive" width="100%">
                    <thead>
                        <tr>
                            <th>Barcode</th>
                            <th>NCCC ID</th>
                            <th>Library</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <style>
        .form-wrapper {
            background: rgba(235,235,235,1);
            padding: 8px;
        }
        .form-wrapper label {
            font-size: 16px;
            margin-right: 12px;
            margin-left: 10px;
            display: inline-block;
        }
        .form-wrapper button {
            margin-right: 10px;
            margin-left: 8px;
            top: 2px;
            position: relative;
        }
        .top {
            height: 40px;
        }
        .top #datatable_info,
        .top #datatable_length {
            width: 300px;
            display: block;
            float: left;
        }
    </style>
    @include('admin.inventory.modals.add-inventory')
@endsection
@push('scripts')
    <script>
        $(function() {
            var oTable = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                saveState: true,
                responsive: true,
                pageLength: '100',
                dom: '<"top"li>rft<"bottom"lp><"clear">',
                ajax: {
                    url: '{{ url("admin/datatables/inventories-data") }}',
                    data: function (d) {
                        d.status_code = $('select[name=status_code]').val();
                    }
                },
                columns: [
                    {data: 'barcode', name: 'barcode'},
                    {data: 'nccc_id', name: 'nccc_id'},
                    {data: 'library_name', name: 'libraries.library_name'},
                    {data: 'status_name', name: 'inventory_status.status_name'},
                    {data: 'action', name: 'action', className: 'print-hide', searchable: false, orderable: false},
                ],
                initComplete: function () {
                    $.each($.fn.dataTable.tables(true), function () {
                        $(this).DataTable()
                            .columns.adjust()
                            .responsive.recalc();
                    });
                }
            });

            $('#search-form').on('submit', function(e) {
                console.log($('select[name=status_code]').val());
                oTable.draw();
                e.preventDefault();
            });


        });
    </script>
@endpush