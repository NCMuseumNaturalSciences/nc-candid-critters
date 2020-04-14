@extends('layouts.coreui.master')
@section('title', 'Update Reservation')
@section('content')
    @include('layouts.status')
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header @if($reservation->closed_yn == 1) bg-danger @elseif($reservation->closed_yn == 0) bg-success @endif">
                Update Reservation {{ $reservation->id }}
            </div>
            <div class="card-body">
                <h3 class="form-header">Library: {{ $reservation->inventory->library->library_name }}</h3>
                {!! Form::model($reservation, ['method' => 'PATCH', 'action' => ['Admin\ReservationsController@update', $reservation->id], 'class' => 'admin-parsley-form' ]) !!}
                {!! Form::hidden('reservation_id',$reservation->id) !!}
                @include('errors.form_error')
                @include('admin.reservations.edit-form', ['btnclass' => 'btn btn-custom-update center-block', 'submitTextButton' => 'Update Reservation'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $("#closed-wrapper").hide();
        $(".close-btn").hide();
        $(".update-btn").show();
        $(document).ready(function() {
            $("#date-input-2").prop('disabled', false);
            $('input[type=radio][name=closed_yn]').change(function() {
                if(this.value == 1) {
                    $("#date-input-2").prop("disabled", false);
                    $(".close-btn").show();
                    $(".update-btn").hide();
                    $("#closed-wrapper").slideDown();
                }
                else {
                    $("#date-input-2").prop("disabled", true);
                    $(".close-btn").hide();
                    $(".update-btn").show();
                    $("#closed-wrapper").hide();
                }
            });
           $('#librarySelect').on('change', function() {
                var library_id = $('#librarySelect').val();
                $.get("admin/libraries/" + library_id + "/volunteers").done(function( data ) {
                    $('#volunteers').empty();
                    $.each(data, function(i, value){
                        $('#volunteers').append('<option value="'+value.volunteer_id+'">' + value.volunteer_name + '</option>');
                    });
                });
                $.get("admin/libraries/" + library_id + "/inventory/available").done(function( data ) {
                    $('#inventory').empty();
                    $.each(data, function(i, value){
                        $('#inventory').append('<option value="'+value.id+'">' + value.barcode + '</option>');
                    });
                });
            });
        });
    </script>
@endpush
