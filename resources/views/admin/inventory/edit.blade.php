@extends('layouts.coreui.master')
@section('title', 'Update Inventory')
@section('content')
    @include('layouts.status')
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                Update Inventory
            </div>
            <div class="card-body">
                {!! Form::model($inventory, ['method' => 'PATCH', 'action' => ['Admin\InventoryController@update', $inventory->id] ]) !!}
                @include('errors.form_error')
                @include('admin.inventory.form', ['btnclass' => 'btn btn-custom-update center-block', 'submitTextButton' => 'Update Inventory'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
