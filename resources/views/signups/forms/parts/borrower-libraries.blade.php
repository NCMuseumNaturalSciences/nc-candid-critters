<h3>Camera Pickup and Drop-off</h3>
<fieldset class="striped">
    <div class="row">
        <div class="row">
            <div class="col col-xs-12">
                <p>Click the dropdown to view a list of libraries around the state where cameras can be picked up. You must return your camera to the same library you checked it out from at the conclusion of your participation with the project. Click here to the <a href="{{ url('/map/libraries') }}" target="_blank">find the nearest library to me</a>. <span class="text-danger text-required">*</span></p>
                <div class="button-row">
                    {!! Form::label('library_id', 'Please select the library location where you would like to checkout a camera:') !!}
                    <select name="library_id" class="form-control select-library" id="selectLibrary" width="100%" required>
                        <option value=""></option>
                        @foreach($libraries as $l)
                            <option value="{{ $l->id }}">{{ $l->library_name }} ({{ $l->street_address }} {{ $l->city }}, NC {{ $l->zip }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    <div class="col col-xs-12">
                        <p><a href="{{ url('map/libraries') }}" target="_blank">Find Nearest Library</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="form-group">
                <label class="label-for-check">I agree to pick up and drop off a camera at <span class="library-name"></span><span class="library-general">the selected public library</span>. <span class="text-danger text-required">*</span></label>
                {{ Form::cbGroup([
                        'cbtype' => 'primary',
                        'value' => '1',
                        'name' => 'library_yn',
                        'id' => 'commit_library',
                        'label' => 'Yes.',
                        'required'
                    ], $errors)
                }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="form-group">
                <label class="label-for-check">I commit to using my camera to collect data during the time that it is borrowed, and not allowing it to remain unused. I also commit to promptly returning it when I no longer have time to use it. <span class="text-danger text-required">*</span></label>
                {{ Form::cbGroup([
                    'cbtype' => 'primary',
                    'value' => '1',
                    'name' => 'commit_return_yn',
                    'id' => 'commit',
                    'label' => 'I Agree.',
                    'required'
                ], $errors)
                }}
            </div>
        </div>
    </div>
</fieldset>