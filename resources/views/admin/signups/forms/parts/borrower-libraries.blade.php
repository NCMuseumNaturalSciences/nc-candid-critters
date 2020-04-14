<h4 class="form-subtitle">Llibrary</h4>
<fieldset>
    <div class="row">
        @if(!empty($library))
        <div class="col-md-6 col-xs-12">
            <p>Current Selected Library: {{ $library->library_name }}</p>
        </div>
        @endif
        <div class="col-md-6 col-xs-12">
            <label>Select New Library</label>
            <select name="library_id" class="form-control">
                <option value=""></option>
                @foreach($libraries as $l)
                    <option value="{{ $l->id }}">{{ $l->library_name }} ({{ $l->street_address }} {{ $l->city }}, NC {{ $l->zip }})</option>
                @endforeach
            </select>
        </div>
    </div>
</fieldset>


