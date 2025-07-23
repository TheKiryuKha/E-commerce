<x-mail::message>

    # Hello!

    Here is your authentication code.

    {{   $code   }}

    If you did not authenticate, no further action is required.

    Regards,
    {{ config('app.name') }}

    © {{ config('app.name') }}. All rights reserved.
</x-mail::message>