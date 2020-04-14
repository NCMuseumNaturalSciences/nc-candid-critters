@extends('layouts.coreui.master')
@section('title', 'Create Reservation')
@section('content')
    @include('layouts.status')
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                Create Reservation
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        {!! Form::open(['route' => 'admin.reservation.create']) !!}
                        @include('errors.form_error')
                        @include('admin.reservations.form', ['btnclass' => 'btn btn-success center-block', 'submitTextButton' => 'Add Reservation'])
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.date-input').mask('99/99/9999');
            $('#librarySelect').on('change', function() {
                console.log("changed");
                var library_id = $('#librarySelect').val();
                console.log(library_id);
                $.get("/admin/libraries/" + library_id + "/volunteers").done(function( data ) {
                    console.log(data);
                    $('#volunteers').empty();
                    $.each(data, function(i, value){
                        console.log(value);
                        $('#volunteers').append('<option value="'+value.volunteer_id+'">' + value.volunteer_name + '</option>');
                    });
                });
                $.get("/admin/libraries/" + library_id + "/inventory/available").done(function( data ) {
                    console.log(data);
                    $('#inventory').empty();
                    $.each(data, function(i, value){
                        console.log(value);
                        $('#inventory').append('<option value="'+value.id+'">' + value.nccc_id + ' (barcode ' + value.barcode + ')</option>');
                    });
                });
            });
        });
    </script>
@endpush
