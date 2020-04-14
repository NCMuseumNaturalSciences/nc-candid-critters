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
                    <div class="col-md-12">
                        {!! Form::open(['route' => 'librarian.reservation.create']) !!}
                        @include('errors.form_error')
                        @include('librarian.reservations.form', ['btnclass' => 'btn btn-custom-success center-block', 'submitTextButton' => 'Add Reservation'])
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
        });
    </script>
@endpush
