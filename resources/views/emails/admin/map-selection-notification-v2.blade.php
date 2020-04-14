<!-- map-selection-notification-v2.blade.php sent via Mail\MapSelectionAdminNotification via EmailTestsController@sendMapSelectionTest() -->
<div class="email-wrapper">
    <p>
        A new NC Candid Critters site has been selected. Information is provided below with a direct link submission.
    </p>
    <ul>
        <li>Deployment Name: {{ $sd->deployment_name }}</li>
        <li>Name: {{ $sd->first_name }} {{ $sd->last_name }}</li>
        <li>Email: {{ $sd->email }}</li>
        <li>Submitted On: {{ $dt->format('g:i A') }} {{ $dt->format('l F d, Y') }}</li>
    </ul>

    <p><a href="https://candid.naturalsciences.org/admin/map-selections/{{ $sd->id }}/show">View Selection</a></p>
</div>