@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        {{-- User {{ $data['membername'] }} Booked done --}}
    @endslot

    {{-- Body --}}
    @component('mail::message')

        {!! $data !!}

    @endcomponent

    {{-- Subcopy --}}
    @slot('subcopy')
        @component('mail::subcopy')
            <!-- subcopy here -->
        @endcomponent
    @endslot

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            <!-- footer here -->
        @endcomponent
    @endslot
@endcomponent
