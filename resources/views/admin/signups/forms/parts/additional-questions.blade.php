<fieldset>
    <h4>Additional Questions</h4>
    <div class="row">
        <div class="col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('interests', 'What about this project interests you?') !!}
                {!! Form::text('interests', $signup->interests, ['class'=> 'form-control']) !!}
            </div>
        </div>
        <div class=" col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('comments', 'Please provide us any additional comments.') !!}
                {!! Form::text('comments', $signup->comments, ['class'=> 'form-control']) !!}
            </div>
        </div>
    </div>
</fieldset>
