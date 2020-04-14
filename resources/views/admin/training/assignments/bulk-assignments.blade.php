@extends('layouts.coreui.master')
@section('title', 'Bulk Trainging Assignments'')
@section('content')
    @include('layouts.status')
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                Bulk Training Assignments
            </div>
            <div class="card-body">
                <form id="bulk-assignment-form" role="form">
                    <div class="form-group">
                        <label for="signups">Select Signups</label>
                        <select id="signups-select" class="form-control" name="signups[]" multiple="multiple"></select>
                    </div>

                    <button type="button" id="xlsTrainingAssignments" class="btn btn-md btn-primary">Export</button>
                    <button type="button" id="btnAssignTraining" class="btn btn-md btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#signups-select').select2({
                closeOnSelect: false,
                allowClear: true,
                ajax: {
                    url: '{{ url("api/v1/json/signups") }}',
                    dataType: 'json'
                    // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
                }
            });
        });
    </script>
@endpush

