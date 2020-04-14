@extends('layouts.coreui.master')
@section('title', 'Inventory')
@section('content')
    @include('layouts.status')
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        Inventory
                        <a href="{{ url('admin/inventories') }}" class="btn btn-xs btn-header btn-primary float-right">Back to Master List</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                    <table class="table table-show table-bordered table-striped table-hover">
                        <tbody>
                        <tr>
                            <th class="col-md-4">Barcode</th>
                            <td class="col-md-8">{{ $inventory->barcode }}</td>
                        </tr>
                        <tr>
                            <th>NCCC ID</th>
                            <td>{{ $inventory->nccc_id }}</td>
                        </tr>
                        @if($inventory->library_id)
                        <tr>
                            <th>Library</th>
                            <td>{{ $inventory->library->library_name }}</td>
                        </tr>

                        <tr>
                            <th>Library Contact Name</th>
                            <td>{{ $inventory->library->contact_first_name }} {{ $inventory->library->contact_last_name }}</td>
                        </tr>
                        <tr>
                            <th>Library Contact Information</th>
                            <td>
                                <a href="mailto:{{ $inventory->library->contact_email }}">{{ $inventory->library->contact_email }}</a><br>
                                <a href="tel:{{ $inventory->library->telephone }}">{{ $inventory->library->telephone }}</a>
                            </td>
                        </tr>
                        @else
                            <tr>
                                <th>Library</th>
                                <td>None assigned</td>
                            </tr>
                            @endif
                        <tr>
                            <th>Camera Make and Model</th>
                            <td><a href="{{ url('admin/cameras/'.$inventory->camera_id) }}">{{ $inventory->camera->make }} {{ $inventory->camera->model }}</a></td>
                        </tr>
                        <tr>
                            <th>Inventory Remarks</th>
                            <td>{{ $inventory->remarks }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>@if($inventory->status_id == 1)
                                    Available
                                @elseif($inventory->status_id == 2)
                                    Reserved
                                @elseif($inventory->status_id == 3)
                                    Missing
                                @elseif($inventory->status_id == 4)
                                    Unavailable (Unknown)
                                @elseif($inventory->status_id == 6)
                                    Unavailable (Equipment Failure)
                                @else
                                    Unknown
                                @endif
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-custom-update" href="{{ url('admin/inventories/'.$inventory->id.'/edit') }}"><i class="fa fa-file"></i> Update</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection