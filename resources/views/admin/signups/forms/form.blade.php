
@if($signuptype == '1')
    <!-- Non-uploader Borrower -->

    @include('admin.signups.forms.parts.data-delivery')
    @include('admin.signups.forms.parts.general-information')
    @include('admin.signups.forms.parts.location')
    @include('admin.signups.forms.parts.borrower-libraries')
    @include('admin.signups.forms.parts.additional-questions')
    @include('admin.signups.forms.parts.form-footer')

@elseif($signuptype == '2')
    <!-- Non-uploader BYO -->
    @include('admin.signups.forms.parts.general-information')
    @include('admin.signups.forms.parts.location')
    @include('admin.signups.forms.parts.cameras')
    @include('admin.signups.forms.parts.data-delivery')
    @include('admin.signups.forms.parts.additional-questions')
    @include('admin.signups.forms.parts.form-footer')

@elseif($signuptype == '3')
    <!-- Uploader Borrower -->
    @include('admin.signups.forms.parts.uploads')
    @include('admin.signups.forms.parts.general-information')
    @include('admin.signups.forms.parts.location')
    @include('admin.signups.forms.parts.borrower-libraries')
    @include('admin.signups.forms.parts.additional-questions')
    @include('admin.signups.forms.parts.form-footer')

@elseif($signuptype == '4')
    <!-- Uploader BYO -->
    @include('admin.signups.forms.parts.general-information')
    @include('admin.signups.forms.parts.cameras')
    @include('admin.signups.forms.parts.uploads')
    @include('admin.signups.forms.parts.location')
    @include('admin.signups.forms.parts.additional-questions')
    @include('admin.signups.forms.parts.form-footer')
@else
@endif