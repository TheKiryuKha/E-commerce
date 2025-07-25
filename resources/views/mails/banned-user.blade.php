<x-mail::message>

    # Hello, {{$user->name}} !

    You have been banned in our application. Reason: 'TODO'

    If you do not agree, you can always challenge the administration's decision
    by writing to us: {{ config('mail.from.address') }}

    your application will be reviewed shortly.

    Regards,
    {{ config('app.name') }}

    © {{ config('app.name') }}. All rights reserved.
</x-mail::message>