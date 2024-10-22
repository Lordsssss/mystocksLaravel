<div class="position-relative" wire:click.away="hideDropdown"> <!-- Detect clicks outside -->
    <input type="text" class="form-control" placeholder="Search stocks..." wire:model="searchTerm"
        wire:focus="$set('showDropdown', true)">
    @if($showDropdown && !empty($stocks))
        <ul class="list-group position-absolute" style="z-index: 1000;">
            @foreach($stocks as $stock)
                <li class="list-group-item">
                    <a href="{{ route('stocks.show', $stock->stock_id) }}">{{ $stock->stock_symbol }} -
                        {{ $stock->stock_name }}</a>
                </li>
            @endforeach
        </ul>
    @endif
</div>