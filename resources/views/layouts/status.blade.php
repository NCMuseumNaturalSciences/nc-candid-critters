@if(session('status'))
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Successful!</h4>
                {{ session('status') }}
            </div>
        </div>
    </div>
@endif

@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-exclamation-circle"></i> Error!</h4>
                    {{ $error }}
                </div>
            </div>
        </div>
    @endforeach
@endif

@if(Session::has('flash_message'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        <p>{{ Session::get('flash_message') }}</p>
    </div>
@endif
