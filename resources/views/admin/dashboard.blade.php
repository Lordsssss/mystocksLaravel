@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ __('messages.admin_dashboard') }}</h1>

    @if(session('message'))
        <div class="alert alert-info">
            {{ session('message') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>{{ __('messages.user_id') }}</th>
                <th>{{ __('messages.name') }}</th>
                <th>{{ __('messages.email') }}</th>
                <th>{{ __('messages.account_number') }}</th>
                <th>{{ __('messages.language') }}</th>
                <th>{{ __('messages.profile_image') }}</th>
                <th>{{ __('messages.role') }}</th>
                <th>{{ __('messages.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->user_id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->account_number }}</td>
                    <td>{{ $user->language }}</td>
                    <td>
                        @if($user->profile_image)
                            <img src="{{ $user->profile_image }}" alt="{{ __('messages.profile_image') }}" width="50">
                        @else
                            {{ __('messages.not_available') }}
                        @endif
                    </td>
                    <td>
                        @if($user->role === 0)
                            {{ __('messages.admin') }}
                        @elseif($user->role === 1)
                            {{ __('messages.moderator') }}
                        @else
                            {{ __('messages.normal_user') }}
                        @endif
                    </td>
                    <td>
                        @if($user->role === 2) <!-- Normal User -->
                            <form action="{{ route('admin.upgrade', $user->user_id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="btn btn-sm btn-primary">{{ __('messages.upgrade_to_moderator') }}</button>
                            </form>
                        @elseif($user->role === 1) <!-- Moderator -->
                            <form action="{{ route('admin.demote', $user->user_id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="btn btn-sm btn-warning">{{ __('messages.demote_to_user') }}</button>
                            </form>
                        @else <!-- Admin -->
                            <button class="btn btn-sm btn-secondary" disabled>{{ __('messages.already_elevated') }}</button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection