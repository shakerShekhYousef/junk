@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <!-- header here -->
        @endcomponent
    @endslot

    {{-- Body --}}
    @component('mail::message')

        Dera junk admin: <br>
        Member {{ $report->user->username() }} has send a report of type {{ $report->type }} <br>
        To check this reports data
        <a href="{{ route('jreports.show', $report->id) }}">link</a>

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
