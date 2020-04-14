@extends('layouts.coreui.master')
@section('title', 'Reservation')
@section('content')
    @include('layouts.status')
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header @if($reservation->closed_yn == 1) bg-danger @elseif($reservation->closed_yn == 0) bg-green @endif">
                Reservation {{ $reservation->status->status_name }}
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
                            <th>Camera</th>
                            <td>{{ $reservation->inventory->nccc_id }} (barcode {{ $reservation->inventory->barcode }})</td>
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
                                <th>Inventory Check Remarks</th>
                                <td>{{ $reservation->inventory->checked_remarks }}</td>
                            </tr>
                            <tr>
                                <th>Inventory Status</th>
                                <td>{{ $reservation->inventory->status->status_name }}</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <a class="btn btn-custom-update" href="{{ url('admin/reservations/'.$reservation->id.'/edit') }}"><i class="fa fa-file"></i> Update</a>
            </div>
        </div>
    </div>

@endsection