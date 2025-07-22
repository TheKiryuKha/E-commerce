<x-mail::message>

    # Hello!

    Please click the button below to verify your email address.

    <x-mail::button :url="$link">
        Verify Email Address
    </x-mail::button>

    If you did not create an account, no further action is required.

    Regards,
    {{ config('app.name') }}

    If you're having trouble clicking the "Verify Email Address" button, copy and paste the URL below
    into your web browser: [{{  $link   }}]({{  $link   }})

    © {{ config('app.name') }}. All rights reserved.
</x-mail::message>