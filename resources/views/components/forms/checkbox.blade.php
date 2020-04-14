        <div class="form-check abc-checkbox abc-checkbox-{{ array_get($params, 'cbtype') }}">
                <input
                    type="checkbox"
                    class="form-check-input"
                    id="{{ array_get($params, 'id') }}"
                    name="{{ array_get($params, 'name') }}"
                    value="{{ array_get($params, 'value') }}"
                {{ array_get($params, 'required', false) ? 'required' : '' }}>
            <label class="form-check-label" for="{{ array_get($params, 'id') }}">{{ array_get($params, 'label') }}</label>
        </div>

