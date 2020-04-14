@if(!empty($camera))
    <h4 class="form-subtitle">Cameras</h4>
        <fieldset>
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <p>Current Selected Camera: {{ $camera->make_model }}</p>
                </div>
                <div class="col-md-6 col-xs-12">
                    <label>Select New Camera</label>
                    <select name="camera_id">
                        <option value=""></option>
                        @foreach($cameras as $c)
                            <option value="{{ $c->id }}">{{ $c->make_model }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </fieldset>
    @endif
