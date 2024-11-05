@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>{{ __('messages.update_profile') }}</h1>

    <form action="{{ route('account.update') }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Name Field -->
        <div class="mb-3">
            <label for="name" class="form-label">{{ __('messages.name') }}</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}" required>
        </div>

        <!-- Language Field -->
        <div class="mb-3">
            <label for="language" class="form-label">{{ __('messages.language') }}</label>
            <select class="form-control" id="language" name="language">
                <option value="en" {{ auth()->user()->language === 'en' ? 'selected' : '' }}>English</option>
                <option value="fr" {{ auth()->user()->language === 'fr' ? 'selected' : '' }}>Français</option>
                <option value="es" {{ auth()->user()->language === 'es' ? 'selected' : '' }}>Español</option>
            </select>
        </div>

        <!-- Password Field -->
        <div class="mb-3">
            <label for="password" class="form-label">{{ __('messages.new_password') }}</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <!-- Profile Image URL Field -->
        <div class="mb-3">
            <label for="profile_image" class="form-label">{{ __('messages.profile_image') }}</label>
            <input type="text" class="form-control" id="profile_image" name="profile_image"
                placeholder="{{ __('messages.profile_image_placeholder') }}">
            <small class="form-text text-muted">{{ __('messages.profile_image_info') }}</small>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">{{ __('messages.update_profile_button') }}</button>
    </form>

</div>
@endsection