<x-mail::message>

    # Hello, {{$user->name}} !

    You have been unbanned in our application. Congratulations!

    If your ban was due to an error by the administration, we apologize.
    All your abilities have been restored.

    Regards,
    {{ config('app.name') }}

    © {{ config('app.name') }}. All rights reserved.
</x-mail::message>