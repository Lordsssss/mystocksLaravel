@extends('layouts.app')

@section('content')

<div class="container m-3">
    <section>
        <h2>{{ __('messages.introduction') }}</h2>
        <p>{{ __('messages.welcome_message') }}</p>
    </section>
    <section>
        <h2>{{ __('messages.features') }}</h2>
        <ul>
            <li>{{ __('messages.real_time_updates') }}</li>
            <li>{{ __('messages.portfolio_management') }}</li>
            <li>{{ __('messages.modern_platform') }}</li>
        </ul>
    </section>
    <section>
        <h2>{{ __('messages.contact_us') }}</h2>
        <p>{{ __('messages.contact_message') }}</p>
    </section>
</div>
@endsection