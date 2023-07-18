@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        {{-- New class Book --}}
    @endslot

    {{-- Body --}}
    @component('mail::message')

        <div class="text-center" style=" font-family: 'Futura';color: #5c5656;font-size: 18px;padding-top: 1rem; ">
            <p>Dear {{ $data['member_name'] }} thank you for your order in junk fitness club</p>
            <p>Here you can find a brief description about your order:</p>
            <p>{!! $data['description'] !!}</p>
            <h5>{{ now() }}</h5>
        </div>

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
