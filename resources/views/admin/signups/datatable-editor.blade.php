@extends('layouts.coreui.master')
@section('title', 'Signups with Editor')
@section('content')
    @include('layouts.status')
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                Signups
            </div>
            <div class="card-body" id="editor-datatable">
                <div id="responsive-table" class="table-responsive-sm">
                    <table id="signups" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Assigned</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
            });
            var editor;
            $(document).ready(function() {
                editor = new $.fn.dataTable.Editor({
                    ajax: "/admin/signups/table/store",
                    table: "#signups",
                    display: "bootstrap",
                    idSrc:  'id',
                    fields: [
                        {label: 'ID', name: 'id'},
                        {label: 'First_name', name: 'first_name'},
                        {label: 'Last_name', name: 'last_name'},
                        {label: 'Email', name: 'email'},
                        {
                            label: "Training Assigned?",
                            name:  "training_assigned_yn",
                            type:  "checkbox",
                            className: "training-cb",
                            separator: "|",
                            options:   [
                                { label: '', value: 1 }
                            ]
                        },
                    ]
                });
                $('#signups').on( 'click', 'tbody td:not(:first-child)', function (e) {
                    editor.inline( table.cell( this ).index(), {
                        onBlur: 'submit'
                    } );
                } );
                var table = $('#signups').DataTable({
//                    processing: true,
                    serverSide: true,
                    pageLength: '50',
                    ajax: '{{ url("admin/signups/table/data") }}',
                    columns: [
                        {data: 'id', name: 'id', searchable: false},
                        {data: 'first_name', name: 'first_name'},
                        {data: 'last_name', name: 'last_name'},
                        {data: 'email', name: 'email'},
                        {data: 'training_assigned_yn', name: 'vtraining_assigned_yn'},
                    ],
                });




            })
    </script>
@endpush
