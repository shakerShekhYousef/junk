@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        {{-- @component('mail::header', ['url' => config('app.url')])
            <!-- header here -->
        @endcomponent --}}
    @endslot

    {{-- Body --}}
    @component('mail::message')

        Thank you {{ $data['membername'] }} for Registering with JUNK Fitness Club for more details <br>
        You will receive notifications for every proccess <br>
        <a href="{{ $data['link'] }}">Email verification link</a>
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
