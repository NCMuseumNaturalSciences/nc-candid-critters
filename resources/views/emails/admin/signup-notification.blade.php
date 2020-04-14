<div class="email-wrapper">
    <p>
        A new NC Candid Critters Signup has been submitted. Information is provided below with a direct link submission.
    </p>
    <ul>
        <li>
            @if($uploader_yn == 1)
                Uploader
            @else
                Non-uploader
            @endif
        </li>
        <li>
            @if($borrower_yn == 1)
                Borrower
            @else
                BYO
            @endif
        </li>
        <li>Name: {{ $first_name }} {{ $last_name }}</li>
        <li>Email: {{ $email }}</li>
        <li>Submitted On: {{ $created->format('g:i A') }} {{ $created->format('l F d, Y') }}</li>
    </ul>
    <p><a href="https://candid.naturalsciences.org/admin/signups/{{ $id }}/show">View Signup</a></p>
</div>