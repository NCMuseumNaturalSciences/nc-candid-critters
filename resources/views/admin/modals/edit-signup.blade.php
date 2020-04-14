<div class="modal fade" id="editSignupModal" tabindex="-1" role="dialog" aria-labelledby="editSignupModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSignupModalLabel">Edit Signup MODAL!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => '/admin/signups/edit']) !!}
                {!! Form::hidden('signup_id', $signup->id, ['class' => 'form-control']) !!}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('First Name', 'First Name:') !!}
                                {!! Form::text('first_name', $signup->first_name, ['class'=> 'form-control', 'required']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('Last Name', 'Last Name:') !!}
                                {!! Form::text('last_name', $signup->last_name, ['class'=> 'form-control', 'required']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('Email', 'Email:') !!}
                                {!! Form::text('email', $signup->email, ['class'=> 'form-control', 'required', 'type' => 'email']) !!}
                            </div>
                        </div>
                    </div>
                @if($library)
                    <div class="form-group">
                        {!! Form::label('library_id', 'Library Name:', ['class' => 'control-label']) !!}
                        <select name="library_id" class="form-control">
                            <option value=""></option>
                            @foreach($libraries as $l)
                                <option value="{{ $l->id }}" @if($library->id == $l->id) selected="selected" @endif>{{ $l->library_name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif

                    <div class="form-group">
                        {!! Form::label('admin_remarks', 'Administrative Remarks:', ['class' => 'control-label']) !!}
                        {!! Form::textarea('admin_remarks', $signup->admin_remarks, ['class'=> 'form-control', 'size' => '30x2']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('training_status', 'Training Assigned?', [ 'class' => 'control-label']) !!}<br>
                        <select name="training_status_id" class="form-control">
                            <option value=""></option>
                            @foreach($statusSet as $ts)
                                <option value="{{ $ts->id }}" @if($signup->training_status_id == $ts->id) selected="selected" @endif>{{ $ts->status }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-default btn-success">Update</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<style>
    .modal.signup-modal .modal-body {
        padding: 15px;
    }
    .modal.signup-modal .modal-dialog .modal-header {
        background-color:     #29363d;
    }
    .modal-dialog .modal-header {
        -webkit-box-shadow: 0 2px 5px 0 rgba(0,0,0,.16),0 2px 10px 0 rgba(0,0,0,.12);
        box-shadow: 0 2px 5px 0 rgba(0,0,0,.16),0 2px 10px 0 rgba(0,0,0,.12);
        border: 0;
    }
    .modal-dialog .modal-content .modal-header {
        -webkit-border-top-left-radius: .125rem;
        border-top-left-radius: .125rem;
        -webkit-border-top-right-radius: .125rem;
        border-top-right-radius: .125rem;
    }
    .modal-header {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: start;
        align-items: flex-start;
        -ms-flex-pack: justify;
        justify-content: space-between;
        padding: 1rem;
        border-bottom: 1px solid #e9ecef;
        border-top-left-radius: .3rem;
        border-top-right-radius: .3rem;
    }
</style>