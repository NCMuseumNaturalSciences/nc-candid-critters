@extends('layouts.coreui.master')
@section('title', 'Reservation')
@section('content')
    @include('layouts.status')
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header @if($reservation->closed_yn == 1) bg-danger @elseif($reservation->closed_yn == 0) bg-green @endif">
                Reservation {{ $status->status_name }}
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-show table-bordered table-striped table-hover">
                        <tbody>
                        <tr>
                            <th class="col-md-4">Reservation ID</th>
                            <td class="col-md-8">{{ $reservation->id }}</td>
                        </tr>
                        <tr>
                            <th>Inventory</th>
                            <td>{{ $inventory->barcode }}</td>
                        </tr>
                        <tr>
                            <th>Volunteer</th>
                            <td>{{ $reservation->volunteer->first_name }} {{ $reservation->volunteer->last_name }}</td>
                        </tr>
                        <tr>
                            <th>Volunteer Email</th>
                            <td><a href="{{ $reservation->volunteer->email }}">{{ $reservation->volunteer->email }}</a></td>
                        </tr>
                        <tr>
                            <th>Checked Out By</th>
                            <td><a href="mailto:{{ $reservation->librarian_email }}">{{ $reservation->librarian_name }}</a></td>
                        </tr>
                        <tr>
                            <th>Checked Out By Phone</th>
                            <td>{{ $reservation->librarian_phone }}</td>
                        </tr>
                        <tr>
                            <th>Remarks</th>
                            <td>{{ $reservation->remarks }}</td>
                        </tr>
                        @if($reservation->closed_yn == 1)
                            <tr>
                                <th>Equipment Checked?</th>
                                <td>
                                    @if($reservation->equipment_checked_yn == 1)
                                        Yes
                                        @else
                                    No
                                        @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Closed Reservation Remarks</th>
                                <td>{{ $reservation->close_remarks }}</td>
                            </tr>
                            <tr>
                                <th>Inventory Status</th>
                                <td>{{ $inventory->status->status_name }}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <a class="btn btn-warning" href="{{ url('librarian/reservations/'.$reservation->id.'/edit') }}"><i class="fa fa-file"></i> Update</a>
            </div>
        </div>
    </div>

@endsection