<h3>Additional Questions</h3>
<fieldset>
    <div class="row">
        {{ Form::textGroup([
            'label' => 'What about this project interests you?',
            'name' => 'interests',
            'required' => 'required',
        ], $errors)
        }}
    </div>
    <div class="row">
        {{ Form::textGroup([
            'label' => 'Please provide us any additional comments.',
            'name' => 'comments',
        ], $errors)
        }}
    </div>
</fieldset>
