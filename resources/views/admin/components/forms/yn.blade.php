<div class="form-group">
    {!! Form::label($name, $label, [ 'class' => 'control-label']) !!}<br>
    <label class="checkbox-inline">
        {!! Form::radio($name, 1, $value, ['class' => 'input-rb']) !!}
        Yes
    </label>
    <label class="checkbox-inline">
        {!! Form::radio('acf_borrower_yn', 0, $value, ['class' => 'input-rb']) !!}
        No
    </label>
</div>