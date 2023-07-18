@component('mail::layout')
    {{-- Header --}}
    @slot('header')

    @endslot

    {{-- Body --}}
    @component('mail::message')

        New user {{ $data['membername'] }} has signup to junk for more details <br>
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
