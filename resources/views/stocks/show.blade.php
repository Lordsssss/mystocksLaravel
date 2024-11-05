@extends('layouts.app')

@section('content')
<section id="stock-details" class="container my-5">
    <h1 class="title text-center mb-4">{{ $stock->stock_name }}</h1>

    <p><strong>{{ __('messages.symbol') }}:</strong> {{ $stock->stock_symbol }}</p>
    <p><strong>{{ __('messages.current_price') }}:</strong> ${{ $stock->current_price }}</p>
    <p><strong>{{ __('messages.updated_at') }}:</strong> {{ $stock->updated_at }}</p>
    <p><strong>{{ __('messages.description') }}:</strong> {{ $stock->description }}</p>

    <h2>{{ __('messages.price_history') }}</h2>
    <div id="chart"></div> <!-- Chart container -->
</section>

<!-- Include ApexCharts -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    // Prepare data for the chart
    const priceHistory = @json($priceHistory); // Convert the PHP variable to JavaScript

    // Extract labels (dates) and data (prices)
    const labels = priceHistory.map(entry => entry.price_date);
    const prices = priceHistory.map(entry => entry.price);

    // Set up the chart options
    const options = {
        chart: {
            type: 'line', // You can choose other types like 'bar', 'area', etc.
            height: 350,
        },
        series: [{
            name: "{{ __('messages.price') }}",
            data: prices,
        }],
        xaxis: {
            categories: labels,
            title: {
                text: "{{ __('messages.date') }}",
            },
        },
        yaxis: {
            title: {
                text: "{{ __('messages.price') }}",
            },
        },
        title: {
            text: "{{ __('messages.price_history_for', ['symbol' => $stock->stock_symbol]) }}",
            align: 'center',
        },
    };

    // Create the chart
    const chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
</script>
@endsection
