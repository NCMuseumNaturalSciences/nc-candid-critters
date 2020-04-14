@extends('layouts.coreui.master')
@section('title', 'Inventory'')
@section('content')
    @include('layouts.status')
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                Inventory
            </div>
            <div class="card-body">
                <div id="responsive-table" class="table-responsive-sm">
                    <table id="datatable" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Barcode</th>
                                <th>NCCC ID</th>
                                <th>Status</th>
                                <th>CP</th>
                                <th>PB</th>
                                <th>L</th>
                                <th>IL</th>
                                <th>B</th>
                                <th>SD</th>
                                <th>CW</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>