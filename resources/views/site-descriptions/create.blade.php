@extends('layouts.frontend.master', ['bodyid' => 'public-form'])
@section('title', 'Site Description')
@section('content')
    {!! Form::open(['route' => 'site-descriptions.create', 'class' => 'form-horizontal', 'id' => 'site-description-form']) !!}
        {{ Form::hidden('form-type-id', $id) }}
        @if($id == '1')
            <!-- Non-uploader -->
            {!! Form::hidden('acf_uploader_yn', 0, ['class' => 'uploader_hidden']) !!}
            @include('site-descriptions.forms.nonuploader', ['btnclass' => 'btn btn-success center-block', 'submitTextButton' => 'Submit!'])
        @elseif($id == '2')
            <!-- Uploader -->
            {!! Form::hidden('acf_uploader_yn', 1, ['class' => 'uploader_hidden']) !!}
            @include('site-descriptions.forms.uploader', ['btnclass' => 'btn btn-success center-block', 'submitTextButton' => 'Submit!'])
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
        	 $("#site-description-form").parsley();

            $(".date-input").mask("99/99/9999");
            $(".phone-input").mask("999.999.9999");

//            $.mask.definitions['~']='[-]?';
            $("#latitude").mask("99.9999");
            $("#longitude").mask("-99.9999");
             $("#user_latitude").mask("99.9999");
            $("#user_longitude").mask("-99.9999");

 
            $('#flashModal').modal({
                show: false
            });
            /*
            $(".camera-select-wrapper").hide();
            $("#bb1").click(function () {
                $(".camera-select-wrapper").show("slow");
            });
            $("#bb2").click(function () {
                $(".camera-select-wrapper").hide("slow");
            });
            */

            $("#google-drive").hide();
            $("#sd-cards").hide();
            $("#dm1").prop("checked", false);
            $("#dm2").prop("checked", false);


            $("#dm1").click(function () {
                $("#google-drive").hide();
                $("#sd-cards").show();
            });
            $("#dm2").click(function () {
                $("#sd-cards").hide();
                $("#google-drive").show();
            });


            $("#librariesModal").on("show.bs.modal", function () {
                var height = $(window).height() - 200;
                $(this).find(".modal-body").css("max-height", height);
            });

            var camerasearch = '{{ url("api/v1/cameras/search") }}';

            $("#selectCamera").select2({
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
                            search: params.term
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                }
            });
            $("#selectLibrary").select2({
                width: '100%',
                dropdownAutoWidth: false,
                dropdownCssClass: "select2-library-dropdown",
                theme: 'bootstrap4'
                /*
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
                */
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