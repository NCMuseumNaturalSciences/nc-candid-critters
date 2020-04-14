@extends('layouts.coreui.master')
@section('title', 'Inventory Checklist')
@section('content')
    @include('layouts.status')
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                Inventory Checklist
            </div>
            <div class="card-body">

                {!! Form::model($item, ['method' => 'PATCH', 'action' => ['Admin\InventoryChecksController@update', $item->id] ]) !!}
                @include('errors.form_error')
                @include('admin.inventory.inventory-check.form', ['btnclass' => 'btn btn-custom-update center-block', 'submitTextButton' => 'Submit Check'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

