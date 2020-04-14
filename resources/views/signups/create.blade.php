@extends('layouts.frontend.master', ['bodyid' => 'public-form'])
@section('title', 'Signup')
@section('content')

    {!! Form::open(['route' => 'signups.create', 'class' => 'form-horizontal', 'id' => 'signup-form']) !!}
        {{ Form::hidden('form-type-id', $id) }}
        @if($id == '1')
            @include('signups.forms.nonuploader-borrower', ['btnclass' => 'btn btn-success center-block', 'submitTextButton' => 'Signup!'])
        @elseif($id == '2')
            @include('signups.forms.nonuploader-byo', ['btnclass' => 'btn btn-success center-block', 'submitTextButton' => 'Signup!'])
        @elseif($id == '3')
            @include('signups.forms.uploader-borrower', ['btnclass' => 'btn btn-success center-block', 'submitTextButton' => 'Signup!'])
        @elseif($id == '4')
            @include('signups.forms.uploader-byo', ['btnclass' => 'btn btn-success center-block', 'submitTextButton' => 'Signup!'])
        @else
        @endif
    {!! Form::close() !!}


    @include('modals.flash')
    @include('modals.libraries')
    @include('modals.cameras')
@endsection
@push('scripts')
    @if( Session::has('flash_message'))
        <script type="text/javascript">
                $('#flashModal').modal('show');
        </script>
    @endif

    <script type="text/javascript">
        $(document).ready(function() {
        	 $("#signup-form").parsley();

            $(".date-input").mask("99/99/9999");
            $(".phone-input").mask("999.999.9999");

//            $.mask.definitions['~']='[-]?';
            $("#latitude").mask("99.9999");
            $("#longitude").mask("-99.9999");
            $('#flashModal').modal({
                show: false
            });

            /* Check value on page load to set acf_uploader */
            var rbval = $( 'input[name=delivery_method]:checked' ).val();

            console.log(rbval);
            if (rbval == 'NCCC Software') {
                $('.uploader_hidden').val('1');
            }
            else {
                $('input[name=acf_uploader_yn]').val('0');
            }
            /* Check again everytime uploader is selected */
            $(".delivery-rb").on('change', function () {
                var rbval = $( 'input[name=delivery_method]:checked' ).val();
                console.log(rbval);
                if (rbval == 'NCCC Software') {
                    $('.uploader_hidden').val('1');
                }
                else {
                    $('input[name=acf_uploader_yn]').val('0');
                }
            })

            $("#librariesModal").on("show.bs.modal", function () {
                var height = $(window).height() - 200;
                $(this).find(".modal-body").css("max-height", height);
            });

            var camerasearch = '{{ url("api/v1/cameras/search") }}';

            $("#selectCamera").select2({
                dropdownCssClass: "dropdown-options",
                minimumInputLength: 0,
                allowClear: true,
                theme: "bootstrap4",
                ajax: {
                    cache: true,
                    //quietMillis: 150,
                    url: camerasearch,
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                }
            });
            /*
            $("#selectLibrary").select2({
                width: '100%',
                dropdownAutoWidth: false,
                dropdownParent: $('#librariesModal'),
                dropdownCssClass: "select2-library-dropdown",
                theme: 'bootstrap4',
                allowClear: true,
                ajax: {
                    url: libsearchurl,
                    dataType: 'json',
                    data: function (params) {
                        return {
                            q: $.trim(params.term)
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                }
            });


            $("#btn-library-select").click(function (e) {
                e.preventDefault();
                $("#librariesModal").modal("hide");
                $(".library-general").hide();
                $(".library-hidden").empty();
                $("span.library-name").empty();

                // Library Name
                var libname = $("select.select-library option:selected").text();
                // Library ID
                var lib = $("select.select-library").val();

                $("span.library-name").html(libname);
                $(".library-hidden").val(lib);
                return false;
            });

             */
            $("#btn-camera-select").click(function (e) {
                e.preventDefault();
                $("#camerasModal").modal("hide");
                $(".camera-hidden").empty();
                $("span.camera-name").empty();
                // Camera Name
                var camname = $("select.select-camera option:selected").text();
                // Camera ID
                var cam = $("select.select-camera").val();

                $("span.camera-name").html(camname);
                $(".camera-hidden").val(cam);
                return false;
            });
        });
    </script>
@endpush