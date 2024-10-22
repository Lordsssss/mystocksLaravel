@extends('layouts.app') <!-- Assuming you have a layout file -->
@include('navbar', ['appName' => 'Hugo Montreuil'])

@section('content')
<section id="stocks" class="container my-5">
    <h1 class="title text-center mb-4">Stock Prices</h1>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark"> <!-- Dark header -->
                <tr>
                    <th scope="col">Symbol</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    @if (auth()->check() && auth()->user()->isAdmin()) <!-- Check if the user is logged in and is admin -->
                        <th scope="col">Actions</th> <!-- Added actions column -->
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($stocks as $singleStock) <!-- Changed variable name here -->
                    <tr>
                        <td><a href="{{ route('stocks.show', $singleStock->stock_id) }}">{{ $singleStock->stock_symbol }}</a></td> <!-- Use stock_id -->
                        <td>{{ $singleStock->stock_name }}</td>
                        <td>{{ $singleStock->current_price }}</td>
                        @if (auth()->check() && auth()->user()->isAdmin()) <!-- Show buttons if admin -->
                            <td>
                                <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                <a href="#" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection
