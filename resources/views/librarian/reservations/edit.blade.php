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
                <ul class="model-info">
                    <li>Inventory Barcode: {{ $reservation->inventory->barcode }}</li>
                    <li>Volunteer: <a href="{{ url('librarian/volunteers/'.$reservation->volunteer_id.'/show') }}">{{ $reservation->volunteer->first_name }} {{ $reservation->volunteer->last_name }}</a></li>
                </ul>
                {!! Form::model($reservation, ['method' => 'PATCH', 'action' => ['Librarian\ReservationsController@close', $reservation->id] ]) !!}
                @include('errors.form_error')
                @include('librarian.reservations.edit-form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    @if($action == 'edit')
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
            });
        </script>
    @elseif($action == 'close')
        <script type="text/javascript">
            $("#closed-wrapper").show();
            $(".close-btn").show();
            $(".update-btn").hide();
            $(document).ready(function() {
                $('input[type=radio][name=closed_yn]').val(1)
                $("#date-input-2").prop('disabled', false);

                $('input[type=radio][name=closed_yn]').change(function() {
                    if(this.value == 1) {
                        $("#date-input-2").prop("disabled", false);
                        $("#closed-wrapper").slideDown();
                    }
                    else {
                        $("#date-input-2").prop("disabled", true);
                        $("#closed-wrapper").hide();
                    }
                });
            });
        </script>
    @endif

@endpush
