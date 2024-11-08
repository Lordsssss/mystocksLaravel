@extends('layouts.app')
@section('content')
<section id="stocks" class="container my-5">
    <h1 class="title text-center mb-4">{{ __('messages.stock_prices') }}</h1>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark"> <!-- Dark header -->
                <tr>
                    <th scope="col">{{ __('messages.symbol') }}</th>
                    <th scope="col">{{ __('messages.name') }}</th>
                    <th scope="col">{{ __('messages.price') }}</th>
                    @if (auth()->check() && auth()->user()->role <= 1)
                        <!-- Check if the user is logged in and is admin or moderator -->
                        <th scope="col">{{ __('messages.actions') }}</th> <!-- Added actions column -->
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($stocks as $singleStock)
                    <tr>
                        <td>
                            <a href="{{ route('stocks.show', $singleStock->stock_id) }}">
                                {{ $singleStock->stock_symbol }}
                            </a>
                        </td>
                        <td>{{ $singleStock->stock_name }}</td>
                        <td>{{ $singleStock->current_price }}</td>
                        @if (auth()->check() && auth()->user()->role <= 1)
                            <td>
                                <a href="#" class="btn btn-primary btn-sm">
                                    {{ __('messages.edit') }}
                                    <!-- Edit icon SVG -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-pencil" viewBox="0 0 16 16">
                                        <!-- SVG content -->
                                    </svg>
                                </a>
                                <a href="#" class="btn btn-danger btn-sm">
                                    {{ __('messages.delete') }}
                                    <!-- Delete icon SVG -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-trash" viewBox="0 0 16 16">
                                        <!-- SVG content -->
                                    </svg>
                                </a>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection