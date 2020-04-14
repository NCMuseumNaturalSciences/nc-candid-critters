<div class="modal fade" id="flashModal" role="dialog" aria-labelledby="flashModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <p>
                    {{ Session::get('flash_message') }}
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#flashModal">Close</button>
            </div>
        </div>
    </div>
</div>
