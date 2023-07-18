@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        {{-- User {{ $data['membername'] }} Booked done --}}
    @endslot

    {{-- Body --}}
    @component('mail::message')

    Dear subscriber you have to pay {{ $data['fee_amount'] }} {{ $data['fee_amount_type'] }} due to book cancelation before 8 hours of session {{ $data['session_name'] }} start <br>
    <small>Junk Fitness Club</small>
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
