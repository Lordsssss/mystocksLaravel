@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ __('messages.daily_market_news') }}</h1>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <!-- Bootstrap grid system for responsiveness -->
        @foreach($news as $article)
            @if($article['urlToImage'])
                <div class="col">
                    <div class="card h-100">
                        <img src="{{ $article['urlToImage'] }}" class="card-img-top" alt="News Image">
                        <div class="card-body">
                            <h5 class="card-title">{{ $article['title'] }}</h5>
                            <p class="card-text">
                                {{ Str::limit($article['description'], 100) }} <!-- Limit text to 100 characters -->
                            </p>
                            <a href="{{ $article['url'] }}" target="_blank"
                                class="btn btn-primary">{{ __('messages.read_more') }}</a>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>
@endsection