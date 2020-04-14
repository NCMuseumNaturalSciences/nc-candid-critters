@extends('layouts.coreui.master')

@section('content')
    <h1>Administrator Dashboard</h1>
    <div class="dashboard-stats-wrapper">
        <div class="row">
            <div class="col-md-4">
                <h3>Statistics</h3>
                    <ul class="stats-list">
                        <li><span>All Reservations</span>
                        {{ $stats['reservations-all'] }}</li>
                        <li><span>Open Reservations</span>
                        {{ $stats['reservations-open'] }}</li>
                        <li><span>Closed Reservations</span>
                        {{ $stats['reservations-closed'] }}</li>
                        <li><span>Signups</span>
                        {{ $stats['signups'] }}</li>
                        <li><span>Site Descriptions</span>
                        {{ $stats['site-descriptions'] }}</li>
                        <li><span>Map Sites</span>
                        {{ $stats['map-sites'] }}</li>
                        <li><span>Volunteers</span>
                        {{ $stats['volunteers'] }}</li>
                        <li><span>Deployments</span>
                        {{ $stats['deployments'] }}</li>
                        <li><span>Libraries</span>
                        {{ $stats['libraries'] }}</li>
                        <li><span>Cameras</span>
                        {{ $stats['cameras'] }}</li>
                        <li><span>Inventory</span>
                        {{ $stats['inventory'] }}</li>
                        <li><span>Missing Inventory</span>
                        {{ $stats['inventory-missing'] }}</li>
                        <li><span>Currently Reserved Inventory</span>
                        {{ $stats['inventory-reserved'] }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
