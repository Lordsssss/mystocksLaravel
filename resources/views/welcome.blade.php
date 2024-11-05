@extends('layouts.app')

@section('content')
<div class="container my-5">
    <!-- Header Section -->
    <div class="text-center mb-5">
        <h1 class="display-4">{{ __('messages.about.title') }}</h1>
        <p class="lead">{{ __('messages.about.intro') }}</p>
    </div>

    <!-- Feature Section -->
    <div class="row">
        <!-- Feature Card: Custom Primary Keys -->
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="https://via.placeholder.com/600x300?text=Stock+Management" class="card-img-top" alt="Stock Management">
                <div class="card-body">
                    <h5 class="card-title">{{ __('messages.about.features.custom_primary_keys') }}</h5>
                    <p class="card-text">{{ __('messages.about.features.custom_primary_keys_description') }}</p>
                </div>
            </div>
        </div>

        <!-- Feature Card: Login System -->
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="https://via.placeholder.com/600x300?text=Login+System" class="card-img-top" alt="Login System">
                <div class="card-body">
                    <h5 class="card-title">{{ __('messages.about.features.login_system') }}</h5>
                    <p class="card-text">{{ __('messages.about.features.login_system_description') }}</p>
                </div>
            </div>
        </div>

        <!-- Feature Card: Account Management -->
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="https://via.placeholder.com/600x300?text=Account+Management" class="card-img-top" alt="Account Management">
                <div class="card-body">
                    <h5 class="card-title">{{ __('messages.about.features.account_management.description') }}</h5>
                    <p class="card-text">{{ __('messages.about.features.account_management.profile_picture') }}</p>
                </div>
            </div>
        </div>

        <!-- Feature Card: Language Switching -->
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="https://via.placeholder.com/600x300?text=Language+Switching" class="card-img-top" alt="Language Switching">
                <div class="card-body">
                    <h5 class="card-title">{{ __('messages.about.features.language_switching.description') }}</h5>
                    <p class="card-text">{{ __('messages.about.features.language_switching.persistence') }}</p>
                </div>
            </div>
        </div>

        <!-- Feature Card: Stock Operations -->
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="https://via.placeholder.com/600x300?text=Stock+Tracking" class="card-img-top" alt="Stock Tracking">
                <div class="card-body">
                    <h5 class="card-title">{{ __('messages.about.features.stock_operations.tracking') }}</h5>
                    <p class="card-text">{{ __('messages.about.features.stock_operations.transaction_history') }}</p>
                </div>
            </div>
        </div>

        <!-- Feature Card: Dynamic About Page -->
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="https://via.placeholder.com/600x300?text=About+Page" class="card-img-top" alt="About Page">
                <div class="card-body">
                    <h5 class="card-title">{{ __('messages.about.features.about_page.dynamic_display') }}</h5>
                    <p class="card-text">{{ __('messages.about.features.about_page.home_functionality') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
