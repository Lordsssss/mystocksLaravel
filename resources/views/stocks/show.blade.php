@extends('layouts.app')
@include('navbar', ['appName' => 'Hugo Montreuil'])

@section('content')
<section id="stock-details" class="container my-5">
    <h1 class="title text-center mb-4">{{ $stock->stock_name }}</h1>

    <p><strong>Symbol:</strong> {{ $stock->stock_symbol }}</p>
    <p><strong>Current Price:</strong> ${{ $stock->current_price }}</p>
    <p><strong>Updated At:</strong> {{ $stock->updated_at }}</p>
    <p><strong>Description:</strong> {{ $stock->description }}</p>

    <h2>Price History</h2>
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
        name: 'Price',
        data: prices,
    }],
    xaxis: {
        categories: labels,
        title: {
            text: 'Date',
        },
    },
    yaxis: {
        title: {
            text: 'Price',
        },
    },
    title: {
        text: 'Price History for {{ $stock->stock_symbol }}',
        align: 'center',
    },
};

// Create the chart
const chart = new ApexCharts(document.querySelector("#chart"), options);
chart.render();
</script>
@endsection
