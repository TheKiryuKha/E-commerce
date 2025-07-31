<x-mail::message>

    # Hello, {{$invoice->customer->name}} !

    Your invoice is on way!

    @foreach ($invoice->products as $product)
        {{ $product->title }}
    @endforeach

    Regards,
    {{ config('app.name') }}

    © {{ config('app.name') }}. All rights reserved.
</x-mail::message>