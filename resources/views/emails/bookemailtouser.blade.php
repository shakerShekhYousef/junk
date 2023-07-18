@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        {{-- User {{ $data['membername'] }} Booked done --}}
    @endslot

    {{-- Body --}}
    @component('mail::message')

        Thank you {{ $data['membername'] }} for book our class {{ $data['classname'] }} for more details <br>
        <a href="{{ route('front-classes') }}">Session</a> <br>
        <h5>{{ now() }}</h5>

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
