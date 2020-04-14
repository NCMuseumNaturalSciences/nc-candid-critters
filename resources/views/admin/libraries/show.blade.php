@extends('layouts.coreui.master')
@section('title', 'Library')
@section('content')
    @include('layouts.status')
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                {{ $library->library_name }}
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <h5>General Information</h5>
                        <div class="table-responsive">
                            <table class="table table-show table-bordered table-striped table-hover">
                                <tbody>
                                <tr>
                                    <th>Library Name</th>
                                    <td>{{ $library->library_name }}</td>
                                </tr>
                                <tr>
                                    <th>Telephone</th>
                                    <td>{{ $library->telephone }}</td>
                                </tr>
                                <tr>
                                    <th>Contact First Name</th>
                                    <td>{{ $library->contact_first_name }}</td>
                                </tr>
                                <tr>
                                    <th>Contact Last Name</th>
                                    <td>{{ $library->contact_last_name }}</td>
                                </tr>
                                <tr>
                                    <th>Contact Email</th>
                                    <td>{{ $library->contact_email }}</td>
                                </tr>
                                <tr>
                                    <th>Street Address</th>
                                    <td>{{ $library->street_address }}</td>
                                </tr>
                                <tr>
                                    <th>City</th>
                                    <td>{{ $library->city }}</td>
                                </tr>
                                <tr>
                                    <th>Zip</th>
                                    <td>{{ $library->zip }}</td>
                                </tr>
                                <tr>
                                    <th>County</th>
                                    <td>{{ $library->county }}</td>
                                </tr>
                                <tr>
                                    <th>Region</th>
                                    <td>{{ $library->region }}</td>
                                </tr>
                                <tr>
                                    <th>Latitude</th>
                                    <td>{{ $library->lat }}</td>
                                </tr>
                                <tr>
                                    <th>Longitude</th>
                                    <td>{{ $library->lon }}</td>
                                </tr>
                                <tr>
                                    <th>Partner?</th>
                                    <td>
                                        @if($library->partner_yn == 1)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Remarks</th>
                                    <td>{{ $library->remarks }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <a class="btn btn-custom-update" href="{{ url('/admin/libraries/'.$library->id.'/edit') }}"><i class="fa fa-refresh"></i> Update</a>
                        <a class="btn btn-custom-success" href="{{ url('admin/reservations/create') }}"><i class="fa fa-plus"></i> Create Reservation</a>
                    </div>
                    <div class="col-md-8">
                        <div class="section-wrapper row">
                            <div class="col-md-12">
                                <h5>Current Volunteers</h5>
                                <div class="table-responsive">
                                    <table class="table table-show table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($assignedVolunteers as $assignment)
                                                <tr>
                                                    <td>{{ $assignment->first_name }} {{ $assignment->last_name }}</td>
                                                    <td><a href="mailto:{{ $assignment->email }}">{{ $assignment->email }}</a></td>
                                                        <td>
                                                            <a href="{{ url('admin/volunteers/'.$assignment->volunteer_id.'/show') }}" class="btn btn-custom-view"><i class="fa fa-eye" aria-hidden="true"/></i></a>
                                                        {!! Form::open(['method'=>'DELETE','route' => ['admin.assignment.destroy', $assignment->library_id, $assignment->assignment_id], 'style' => 'display:inline']) !!}
                                                        {!! Form::button('<i class="fa fa-trash" aria-hidden="true"/></i>', array('type' => 'submit','class' => 'btn btn-custom-destroy')) !!}
                                                        {!! Form::close() !!}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <button type="button" class="btn btn-custom-success show-button" data-toggle="modal" data-target="#assignmentModalPost">
                                    <i class="fa fa-hand-paper-o"></i>
                                    Assign Volunteer
                                </button>
                                <!--
                                <a href="{{ url('/admin/libraries/assignments/'.$library->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-hand-o-right"></i>
                                    View Assignments
                                </a>
                                -->
                            </div>
                        </div>
                        <div class="section-wrapper row">
                            <div class="col-md-12">
                                <h5>Open Reservations</h5>
                                <div class="table-responsive">
                                    <table class="table table-show table-bordered table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th>Volunteer</th>
                                            <th>Email</th>
                                            <th>Open Date</th>
                                            <th>NCCC ID</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($reservations as $r)
                                            <tr>
                                                <td><a href="{{ url('admin/volunteers/'.$r->volunteer_id.'/show') }}">{{ $r->volunteer->first_name }} {{ $r->volunteer->last_name }}</a></td>
                                                <td><a href="{{ $r->volunteer->email }}">{{ $r->volunteer->email }}</a></td>
                                                <td>{{ $r->open_date->format('m/d/Y') }}</td>
                                                <td>{{ $r->inventory->nccc_id }}</td>
                                                <td><a href="{{ url('admin/reservations/'.$r->id.'/show') }}" class="btn btn-primary btn-xs">View</a></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="section-wrapper row">
                            <div class="col-md-12">
                                <h5>Current Inventory</h5>
                                @if($library->inventory)
                                    <div class="table-responsive">
                                        <table class="table table-show table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Barcode</th>
                                                    <th>NCCC ID</th>
                                                    <th>Status</th>
                                                    <th class="text-center tt">CP</th>
                                                    <th class="text-center tt">PB</th>
                                                    <th class="text-center tt">L</th>
                                                    <th class="text-center tt">IL</th>
                                                    <th class="text-center tt">B</th>
                                                    <th class="text-center tt">SD</th>
                                                    <th class="text-center tt">CW</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($inventory as $i)
                                                    <tr>
                                                        <td>{{ $i->barcode }}</td>
                                                        <td>{{ $i->nccc_id }}</td>
                                                        <td>
                                                            @if($i->status_id == 1)
                                                                Available
                                                            @elseif($i->status_id == 2)
                                                                Reserved
                                                            @elseif($i->status_id == 3)
                                                                Missing
                                                            @elseif($i->status_id == 4)
                                                                Unavailable (Unknown)
                                                            @elseif($i->status_id == 6)
                                                                Unavailable (Equipment Failure)
                                                            @else
                                                                Unknown
                                                            @endif
                                                        </td>
                                                        @if($i->camera_present_yn == 1)
                                                            <td class="text-center"><i class="fa fa-check text-success"></i></td>
                                                        @else
                                                            <td class="text-center"><i class="fa fa-times text-danger"></i></td>
                                                        @endif
                                                        @if($i->plastic_box_yn == 1)
                                                            <td class="text-center"><i class="fa fa-check text-success"></i></td>
                                                        @else
                                                            <td class="text-center"><i class="fa fa-times text-danger"></i></td>
                                                        @endif
                                                        @if($i->lock_yn == 1)
                                                            <td class="text-center"><i class="fa fa-check text-success"></i></td>
                                                        @else
                                                            <td class="text-center"><i class="fa fa-times text-danger"></i></td>
                                                        @endif
                                                        @if($i->item_list_yn == 1)
                                                            <td class="text-center"><i class="fa fa-check text-success"></i></td>
                                                        @else
                                                            <td class="text-center"><i class="fa fa-times text-danger"></i></td>
                                                        @endif
                                                        @if($i->batteries_yn == 1)
                                                            <td class="text-center"><i class="fa fa-check text-success"></i></td>
                                                        @else
                                                            <td class="text-center"><i class="fa fa-times text-danger"></i></td>
                                                        @endif
                                                        @if($i->sd_cards_yn == 1)
                                                            <td class="text-center"><i class="fa fa-check text-success"></i></td>
                                                        @else
                                                            <td class="text-center"><i class="fa fa-times text-danger"></i></td>
                                                        @endif
                                                        @if($i->camera_working_yn == 1)
                                                            <td class="text-center"><i class="fa fa-check text-success"></i></td>
                                                        @else
                                                            <td class="text-center"><i class="fa fa-times text-danger"></i></td>
                                                        @endif
                                                        <td>
                                                            <a href="{{ url('admin/inventory/'.$i->id.'/check') }}" class="btn btn-custom-success"><i class="fa fa-check-square-o"></i></a>
                                                            {!! Form::open(['method'=>'DELETE','route' => ['admin.library.inventory.destroy', $i->id], 'style' => 'display:inline']) !!}
                                                            {!! Form::button('<i class="fa fa-trash" aria-hidden="true"/></i>', array('type' => 'submit','class' => 'btn btn-custom-destroy')) !!}
                                                            {!! Form::close() !!}
                                                        </td>
                                                    </tr>
                                                    @include('admin.libraries.modals.check-inventory')
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="table-legend">
                                        <ul class="legend-list">
                                            <li><span>CP</span> Camera present</li>
                                            <li><span>PB</span> Plastic Box with Lid</li>
                                            <li><span>L</span> Python lock</li>
                                            <li><span>IL</span> Camera kit item list</li>
                                            <li><span>B</span> Two battery cases with 24-AA lithium batteries (12/each)</li>
                                            <li><span>SD</span> Container with 2 SD Cards and lock key</li>
                                            <li><span>CW</span> Camera working</li>
                                        </ul>
                                    </div>
                                @else
                                    No Inventory Available
                                @endif
                                <button type="button" class="btn btn-custom-success show-button" data-toggle="modal" data-target="#inventoryModalPost">
                                    <i class="fa fa-plus-square"></i>
                                    Add Inventory
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
@endsection
@include('admin.libraries.modals.assign-volunteer')
@include('admin.libraries.modals.add-inventory')
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#checkInventoryModal").on('show.bs.modal', function () {
                $('#inventoryId').val($("#checkInventoryBtn").data('item'));
            });
        });
    </script>
@endpush
