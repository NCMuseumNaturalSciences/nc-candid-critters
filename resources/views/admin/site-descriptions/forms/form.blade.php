<h4>
    Form Type: {{ $formtitle }}

</h4>

@if($type == '1')
    <!-- Non-uploader -->
    @include('admin.site-descriptions.forms.parts.general-information')
    @include('admin.site-descriptions.forms.parts.camera-data-delivery')
    @include('admin.site-descriptions.forms.parts.site-information')
    @include('admin.site-descriptions.forms.parts.form-footer')

@elseif($type == '2')
    <!-- Uploader -->
    @include('admin.site-descriptions.forms.parts.general-information')
    @include('admin.site-descriptions.forms.parts.site-information')
    @include('admin.site-descriptions.forms.parts.form-footer')
@endif