    <div class="col">
        <div class="form-group">
            <label for="{{ array_get($params, 'name') }}" class="control-label">{{ array_get($params, 'label') }} {!! array_get($params, 'required', false) ? '<span class="text-danger text-required">*</span>' : '' !!}</label>
            <input type="text"
                    id="{{ array_get($params, 'name') }}"
                    name="{{ array_get($params, 'name') }}"
                    class="form-control"
                    placeholder="{{ array_get($params, 'placeholder', null) }}"
                    {{ array_get($params, 'required', false) ? 'required' : '' }}>
        </div>
    </div>
