@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        {{-- New class Book --}}
    @endslot

    {{-- Body --}}
    @component('mail::message')

        New member {{ $data['membername'] }} has booked class {{ $data['classname'] }} for more details <br>
        <a href="{{ $data['sessionlink'] }}">Session</a> <br>
        <a href="{{ $data['userlink'] }}">User</a> <br>
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
