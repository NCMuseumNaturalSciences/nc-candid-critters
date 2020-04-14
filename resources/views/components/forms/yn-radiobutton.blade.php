<div class="form-row">
    <div class="col">
        <div class="form-group">
            <label>{{ array_get($params, 'label') }} {!! array_get($params, 'required', false) ? '<span class="text-danger text-required">*</span>' : '' !!}</label>
            <div class="form-check abc-checkbox abc-checkbox-{{ array_get($params, 'rbtype') }}">
                <input
                            type="radio"
                            class="form-check-input"
                            id="{{ array_get($params, 'id') }}Yes"
                            name="{{ array_get($params, 'name') }}"
                            value="1"
                            {{ array_get($params, 'required', false) ? 'required' : '' }}>
                <label class="form-check-label" for="{{ array_get($params, 'id') }}Yes">Yes</label>
            </div>
            <div class="form-check abc-checkbox abc-checkbox-{{ array_get($params, 'rbtype') }}">
                <input
                        type="radio"
                        class="form-check-input"
                        id="{{ array_get($params, 'id') }}No"
                        name="{{ array_get($params, 'name') }}"
                        value="0"
                        {{ array_get($params, 'required', false) ? 'required' : '' }}>
                <label class="form-check-label" for="{{ array_get($params, 'id') }}No">No</label>
            </div>
        </div>
    </div>
</div>


