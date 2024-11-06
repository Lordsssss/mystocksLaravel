<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\StockPrices;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::all(); // Fetch all stocks using Eloquent
        return view('stocks.index', compact('stocks')); // Pass stocks to the view
    }

    public function create()
    {
        return view('stocks.create'); // Return the view for adding a stock
    }

    public function store(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'stock_symbol' => 'required|max:10', // You can customize the validation rules
            'stock_name' => 'required|string|max:255',
            'current_price' => 'required|numeric',
        ]);

        Stock::create($request->all()); // Create a new stock record

        return redirect()->route('stocks.index')->with('success', 'Stock added successfully.'); // Redirect with success message
    }

    public function show($id)
    {
        $stock = Stock::findOrFail($id); // Get the stock by ID
        // Fetch price history for the stock
        $priceHistory = StockPrices::where('stock_symbol', $stock->stock_symbol)
            ->orderBy('price_date', 'asc')
            ->get();

        return view('stocks.show', compact('stock', 'priceHistory')); // Pass both stock and price history data to the view
    }

    public function edit($id)
    {
        $stock = Stock::findOrFail($id); // Fetch stock for editing
        return view('stocks.edit', compact('stock')); // Pass stock to the view
    }

    public function update(Request $request, $id)
    {
        // Validate incoming request
        $request->validate([
            'stock_symbol' => 'required|max:10',
            'stock_name' => 'required|string|max:255',
            'current_price' => 'required|numeric',
        ]);

        $stock = Stock::findOrFail($id); // Fetch stock by ID
        $stock->update($request->all()); // Update stock record

        return redirect()->route('stocks.index')->with('success', 'Stock updated successfully.'); // Redirect with success message
    }

    public function destroy($id)
    {
        $stock = Stock::findOrFail($id); // Fetch stock by ID
        $stock->delete(); // Delete stock record

        return redirect()->route('stocks.index')->with('success', 'Stock deleted successfully.'); // Redirect with success message
    }

    public function searchStocks(Request $request)
    {
        $query = $request->input('query');

        $stock = Stock::where('stock_name', 'like', "%{$query}%")
            ->orWhere('stock_symbol', 'like', "%{$query}%")
            ->get(['stock_id', 'stock_name', 'stock_symbol', 'current_price']);

        return response()->json($stock);
    }
}
