@extends('layouts.app') <!-- Assuming you have a layout file -->

@section('content')
    <section id="stocks">
        <h1 class="title">Stock Prices</h1>
        <table class="table">
            <tr>
                <th>Symbol</th>
                <th>Name</th>
                <th>Price</th>
                <th>Actions</th> <!-- Added actions column -->
            </tr>
            @foreach ($stocks as $stock)
                @if (!$stock->deleted)
                    <tr>
                        <td>{{ $stock->stock_symbol }}</td>
                        <td>{{ $stock->stock_name }}</td>
                        <td>{{ $stock->current_price }}</td>
                    </tr>
                @endif
            @endforeach
        </table>
    </section>
@endsection
