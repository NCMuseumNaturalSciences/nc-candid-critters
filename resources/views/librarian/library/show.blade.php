@extends('layouts.coreui.master')
@section('content')
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                My Library: {{ $library->library_name }}
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
                                    <th>Remarks</th>
                                    <td>{{ $library->remarks }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2"><a class="btn btn-custom-update" href="{{ url('librarian/library/'.$library->id.'/edit') }}"><i class="fa fa-refresh"></i> Update Library</a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
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
                                                <th>Phone</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($assignedVolunteers as $assignment)
                                                <tr>
                                                    <td>{{ $assignment->first_name }} {{ $assignment->last_name }}</td>
                                                    <td><a href="mailto:{{ $assignment->email }}">{{ $assignment->email }}</a></td>
                                                    <td><a href="tel:{{ $assignment->telephone }}">{{ $assignment->telephone }}</a></td>
                                                    <td><a href="{{ url('librarian/volunteer/'.$assignment->assignment_id.'/show') }}" class="btn btn-custom-view">View</a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="section-wrapper row">
                            <div class="col-md-12">
                                <div class="title-row clearfix">
                                    <h5 class="float-left">Current Inventory</h5>
                                    <button type="button" class="btn btn-custom-view float-right" data-toggle="modal" data-target="#libraryHelpModalCenter">Help</button>
                                </div>
                                @if($inventory)
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
                                            @foreach($inventory as $camera)
                                                <tr>
                                                    <td>{{ $camera->barcode }}</td>
                                                    <td>{{ $camera->nccc_id }}</td>
                                                    <td>
                                                        @if($camera->status_id == 1)
                                                            Available
                                                        @elseif($camera->status_id == 2)
                                                            Reserved
                                                        @elseif($camera->status_id == 3)
                                                            Missing
                                                        @elseif($camera->status_id == 4)
                                                            Unavailable (Unknown)
                                                        @elseif($camera->status_id == 6)
                                                            Unavailable (Equipment Failure)
                                                        @else
                                                            Unknown
                                                        @endif
                                                    </td>
                                                    @if($camera->camera_present_yn == 1)
                                                        <td class="text-center"><i class="fa fa-check text-success"></i></td>
                                                    @else
                                                        <td class="text-center"><i class="fa fa-times text-danger"></i></td>
                                                    @endif
                                                    @if($camera->plastic_box_yn == 1)
                                                        <td class="text-center"><i class="fa fa-check text-success"></i></td>
                                                    @else
                                                        <td class="text-center"><i class="fa fa-times text-danger"></i></td>
                                                    @endif
                                                    @if($camera->lock_yn == 1)
                                                        <td class="text-center"><i class="fa fa-check text-success"></i></td>
                                                    @else
                                                        <td class="text-center"><i class="fa fa-times text-danger"></i></td>
                                                    @endif
                                                    @if($camera->item_list_yn == 1)
                                                        <td class="text-center"><i class="fa fa-check text-success"></i></td>
                                                    @else
                                                        <td class="text-center"><i class="fa fa-times text-danger"></i></td>
                                                    @endif
                                                    @if($camera->batteries_yn == 1)
                                                        <td class="text-center"><i class="fa fa-check text-success"></i></td>
                                                    @else
                                                        <td class="text-center"><i class="fa fa-times text-danger"></i></td>
                                                    @endif
                                                    @if($camera->sd_cards_yn == 1)
                                                        <td class="text-center"><i class="fa fa-check text-success"></i></td>
                                                    @else
                                                        <td class="text-center"><i class="fa fa-times text-danger"></i></td>
                                                    @endif
                                                    @if($camera->camera_working_yn == 1)
                                                        <td class="text-center"><i class="fa fa-check text-success"></i></td>
                                                    @else
                                                        <td class="text-center"><i class="fa fa-times text-danger"></i></td>
                                                    @endif
                                                    <td>
                                                        @if($camera->status_id == 1)
                                                            <a href="{{ url('librarian/reservations/create/'.$camera->id) }}" class="btn btn-custom-view">Reserve</a>
                                                        @endif
                                                        <a href="{{ url('librarian/inventory/'.$camera->id.'/edit') }}" class="btn btn-custom-update">Update</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                @else
                                    No Inventory Available
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a class="btn btn-custom-view" href="{{ url('librarian/reservations/open') }}"><i class="fa fa-file"></i> Reservations</a>
                <a class="btn btn-custom-success" href="{{ url('librarian/reservations/create') }}"><i class="fa fa-plus"></i> Create Reservation</a>

            </div>
        </div>
    </div>
    <style>
        .modal-body h6 {
            font-size: 115%;
            margin-bottom: 12px;
            font-weight: 600;
        }
        dl.legend-dl dd {
            width: 88%;
        }
        dl.legend-dl dt {
            width: 12%;
        }
        dl.legend-dl dd,
        dl.legend-dl dt {
            display: inline-block;

        }
        dl.legend-dl dd:after {
            display: block;
        }
        .bg-custom-view {
            color: #FFFFFF;
            background-color: #023B5D;
            border-color: #044B75;
        }
        .bg-custom-view .modal-title,
        .bg-custom-view span,
        .bg-custom-view button span,
        .bg-custom-view h5 {
            color: #FFFFFF;
        }

    </style>
    @include('librarian.modals.library-help-modal')
@endsection