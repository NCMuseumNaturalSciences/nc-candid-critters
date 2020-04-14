@extends('layouts.coreui.master')
@section('title', 'Update Deployment')
@section('content')
    @include('layouts.status')
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                Update Deployment {{ $deployment->id }}
            </div>
            <div class="card-body">
                {!! Form::model($deployment, ['method' => 'PATCH', 'action' => ['Admin\DeploymentsController@update', $deployment->id] ]) !!}
                @include('errors.form_error')
                @include('admin.deployments.form', ['btnclass' => 'btn btn-custom-update center-block', 'submitTextButton' => 'Update Deployment'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#selectVolunteer-search').select2({});

            var volunteerSearch = '{{ url("/api/v1/volunteers/search") }}';
            console.log(volunteerSearch);
            $("#selectVolunteer").select2({
                dropdownCssClass: "dropdown-options",
                minimumInputLength: 1,
                allowClear: true,
                theme: "bootstrap4",
                ajax: {
                    url: volunteerSearch,
                    cache: true,
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function (data) {
                        console.log(data);
                        return {
                            results: data
                        };

                    },
                }
            });
        });
    </script>
@endpush
