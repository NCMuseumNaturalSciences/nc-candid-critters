<div class="search-wrapper" id="search-signups-wrapper">
    <h3 class="accordian-subtitle">
        <a href="#signups-search-form" class="show panel-toggle accordian-toggle" data-toggle="collapse"><span class="link-text">Search Signups<i class="fa fa-angle-up"></i></span></a>
    </h3>
    <form method="POST" id="signups-search-form" class="form-horizontal datatable-filter-form" role="form" class="show">
        <fieldset class="search-fieldset col-lg-10 col-md-12 col-sm-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-check abc-checkbox abc-checkbox-primary">
                                    <input class="form-check-input" id="taCB" name="training_assigned_yn" value="1" type="checkbox">
                                    <label class="form-check-label" for="taCB">
                                        Training Assigned
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-check abc-checkbox abc-checkbox-primary">
                                    <input class="form-check-input" id="tcCB" name="training_completed_yn" value="1" type="checkbox">
                                    <label class="form-check-label" for="tcCB">
                                        Training Completed
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-check abc-checkbox abc-checkbox-primary">
                                    <input class="form-check-input" id="vCB" name="volunteer_yn" value="1" type="checkbox">
                                    <label class="form-check-label" for="vCB">
                                        Volunteer
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group form-inline">
                        <label>Submission Dates: </label>
                        <div class="input-group">
                            <input name="submission-start-date" id="submission-start-date" class="submission-date form-control-sm control-left" type="text">
                            <span class="input-group-append">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </span> -
                            <input name="submission-end-date" id="submission-end-date" class="submission-date form-control-sm control-right" type="text">
                            <span class="input-group-append">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group btn-group">
                        <input class="btn btn-primary center-block" value="SEARCH" type="submit">
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
</div>