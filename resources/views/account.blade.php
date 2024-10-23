@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Update Profile</h1>

    <form action="{{ route('account.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">New Password (leave blank if not changing)</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <div class="mb-3">
            <label for="profile_image" class="form-label">Profile Image URL</label>
            <input type="text" class="form-control" id="profile_image" name="profile_image"
                placeholder="Enter image URL">
            <small class="form-text text-muted">Please provide a direct link to your profile image.</small>
        </div>

        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>
@endsection