@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        {{-- User {{ $data['membername'] }} Booked done --}}
    @endslot

    {{-- Body --}}
    @component('mail::message')

        Dear member {{ $data['username'] }} we notify you that session {{ $data['classname'] }} will open at
        {{ $data['opendate'] }} <br>
        Start time {{ $data['starttime'] }} and it will remain till {{ $data['endtime'] }} if it is you'r first class you
        should come before one half hour.<br>
        <h5>{{ now() }}</h5>
    @endcomponent

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
