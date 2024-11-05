<footer class="bg-dark text-light py-4">
    <div class="container">
        <div class="row">
            <!-- About Section -->
            <div class="col-md-4">
                <h5>{{ __('about_us') }}</h5>
                <p>
                    {{ __('We provide the best stock analysis and updates. Stay connected to get the latest stock prices and insights.') }}
                </p>
            </div>

            <!-- Quick Links Section -->
            <div class="col-md-4">
                <h5>{{ __('quick_links') }}</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('home') }}" class="text-light">{{ __('home') }}</a></li>
                    <li><a href="{{ route('stocks.index') }}" class="text-light">{{ __('stock') }}</a></li>
                </ul>
            </div>

            <!-- Contact Info Section -->
            <div class="col-md-4">
                <h5>{{ __('contact_info') }}</h5>
                <ul class="list-unstyled">
                    <li><i class="bi bi-geo-alt"></i> 123 Market St, NY</li>
                    <li><i class="bi bi-envelope"></i> info@stocksite.com</li>
                    <li><i class="bi bi-phone"></i> +1 234 567 890</li>
                </ul>
            </div>
        </div>

        <hr class="bg-light">

        <div class="row">
            <div class="col text-center">
                <p>{{ __('github_credit') }}
                    <a href="https://github.com/Lordsssss/mystocksLaravel" class="text-decoration-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-github" viewBox="0 0 16 16">
                            <path
                                d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27s1.36.09 2 .27c1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.01 8.01 0 0 0 16 8c0-4.42-3.58-8-8-8" />
                        </svg>
                    </a>
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col text-center">
                <p>&copy; {{ date('Y') }} StockSite. {{ __('all_rights_reserved') }}</p>
            </div>
        </div>
    </div>
</footer>