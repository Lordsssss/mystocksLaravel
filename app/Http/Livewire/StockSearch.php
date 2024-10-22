<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Stock;

class StockSearch extends Component
{
    public $searchTerm = '';
    public $stocks = [];
    public $showDropdown = false;

    public function updatedSearchTerm()
    {
        $this->stocks = Stock::where('stock_symbol', 'like', '%' . $this->searchTerm . '%')
            ->orWhere('stock_name', 'like', '%' . $this->searchTerm . '%')
            ->get();

        // Show the dropdown when the search term is updated
        $this->showDropdown = !empty($this->stocks);
    }

    public function hideDropdown()
    {
        $this->showDropdown = false;
    }

    public function render()
    {
        return view('livewire.stock-search');
    }
}

