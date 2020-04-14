@extends('layouts.coreui.master')
@section('title', 'Export Spreadsheets')
@section('content')
    @include('layouts.status')
    <div class="animated fadeIn">
        <div class="col-lg-10 col-md-12">
            <div class="card">
                <div class="card-header">
                    Export Spreadsheets Dashboard
                </div>
                <div class="card-body card-show">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="list-group export-list">
                                <ul class="export-list">
                                    <li><a class="btn btn-md btn-primary-pulse export-btn" href="{{ url('/admin/export/master-inventory') }}">Export Master Inventory</a></li>
                                    <li><a class="btn btn-md btn-primary-pulse export-btn" href="{{ url('/admin/export/signups') }}">Export All Signups</a></li>
                                    <li><a class="btn btn-md btn-primary-pulse export-btn" href="{{ url('/admin/export/site-descriptions') }}">Export All Site Descriptions</a></li>
                                    <li><a class="btn btn-md btn-primary-pulse export-btn" href="{{ url('/admin/export/deployments') }}">Export All Deployments</a></li>
                                    <li><a class="btn btn-md btn-primary-pulse export-btn" href="{{ url('/admin/export/volunteers') }}">Export All Volunteers</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            {!! Form::open(['route' => 'admin.export.training', 'class' => 'form-horizontal export-filter-form', 'id' => 'export-training-form']) !!}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="start_date">Start Date</label>
                                            <div class="input-group">
                                                <span class="input-group-prepend">
                                                  <span class="input-group-text">
                                                    <i class="fa fa-calendar"></i>
                                                  </span>
                                                </span>
                                                <input type="text" class="form-control datefieldext" name="start_date">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="end_date">End Date</label>
                                            <div class="input-group">
                                                <span class="input-group-prepend">
                                                  <span class="input-group-text">
                                                    <i class="fa fa-calendar"></i>
                                                  </span>
                                                </span>
                                                <input type="text" class="form-control datefield" name="end_date">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="btn-group">
                                            <button type="submit" class="btn btn-primary-pulse btn-md">Get Signups</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        ul.export-list {
            margin: 0;
            padding: 0;
            list-style-type: none;
        }
        ul.export-list li {
            padding: 10px 5px;
        }
        ul.export-list li a {
            width: 250px;
        }
    </style>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(function() {
//            $(".datefield").datepicker({
//            });
        });
    </script>

@endpush