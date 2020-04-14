<div class="email-wrapper">
    <p>
        A new NC Candid Critters site has been selected. Information is provided below with a direct link submission.
    </p>
    <ul>
        <li>Name: {{ $first_name }} {{ $last_name }}</li>
        <li>Email: {{ $email }}</li>
        <li>Submitted On: {{ $created->format('g:i A') }} {{ $created->format('l F d, Y') }}</li>
    </ul>
    <p><a href="https://candid.naturalsciences.org/admin/map-selections/{{ $id }}/show">View Selection</a></p>
</div>