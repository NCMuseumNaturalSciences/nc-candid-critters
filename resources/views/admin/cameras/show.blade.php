@extends('layouts.coreui.master')
@section('title', 'Camera')
@section('content')
    @include('layouts.status')
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                Camera
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-show table-bordered table-striped table-hover">
                        <tbody>
                            <tr>
                                <th class="col-md-4">Make Model</th>
                                <td class="col-md-8">{{ $camera->make }} {{ $camera->model }} {{ $camera->model_number }}</td>
                            </tr>
                            <tr>
                                <th>Trigger Speed</th>
                                <td>{{ $camera->trigger_speed }}</td>
                            </tr>
                            <tr>
                                <th>Product URL</th>
                                <td><a href="{{ $camera->product_url }}">{{ $camera->product_url }}</a></td>
                            </tr>
                            <tr>
                                <th>Remarks</th>
                                <td>{{ $camera->remarks }}</td>
                            </tr>
                            <tr>
                                <th>Acceptable?</th>
                                <td>@if($camera->acceptable_yn == 1)
                                        Yes
                                    @else
                                        No
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <a class="btn btn-custom-update" href="{{ url('admin/cameras/'.$camera->id.'/edit') }}"><i class="fa fa-file"></i> Update</a>
            </div>
        </div>
    </div>

@endsection