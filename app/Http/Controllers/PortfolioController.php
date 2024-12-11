<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Stock;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{


    public function buyStock(Request $request)
    {
        $user = auth()->user();

        // Validate the request
        $request->validate([
            'stock_id' => 'required|exists:stock,stock_id', // Updated table name
            'quantity' => 'required|integer|min:1',
        ]);

        // Check if stock already exists in the user's portfolio
        $portfolio = Portfolio::where('account_number', $user->account_number)
            ->where('stock_id', $request->stock_id)
            ->first();

        if ($portfolio) {
            // Update the quantity if stock already exists
            $portfolio->quantity += $request->quantity;
            $portfolio->save();
        } else {
            // Add new stock to the portfolio
            Portfolio::create([
                'account_number' => $user->account_number,
                'stock_id' => $request->stock_id,
                'quantity' => $request->quantity,
            ]);
        }

        return response()->json([
            'message' => 'Stock purchased successfully.',
        ]);
    }

    public function getOwnedStocks()
    {
        try {
            $user = auth()->user();

            // Fetch the user's portfolio along with stock details
            $stocks = $user->portfolio()->with('stock')->get();

            return response()->json($stocks->map(function ($portfolio) {
                return [
                    'id' => $portfolio->id,
                    'stock_id' => $portfolio->stock_id,
                    'stock_symbol' => $portfolio->stock->stock_symbol, // Add stock symbol
                    'stock_name' => $portfolio->stock->stock_name,     // Add stock name
                    'quantity' => $portfolio->quantity,
                    'image_url' => $portfolio->image_url,             // Include image_url
                ];
            }));
        } catch (\Exception $e) {
            // Log any errors for debugging
            \Log::error('Error fetching owned stocks: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch owned stocks'], 500);
        }
    }

    public function updateImageUrl(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'stock_id' => 'required|exists:portfolio,stock_id',
            'image_url' => 'required|url',
        ]);

        $portfolio = Portfolio::where('account_number', $user->account_number)
            ->where('stock_id', $request->stock_id)
            ->first();

        if (!$portfolio) {
            return response()->json(['error' => 'Stock not found in portfolio'], 404);
        }

        $portfolio->image_url = $request->image_url;
        $portfolio->save();

        return response()->json(['message' => 'Image URL updated successfully.', 'image_url' => $portfolio->image_url]);
    }

    public function sellStock(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'stock_id' => 'required|exists:portfolio,stock_id',
            'quantity' => 'required|integer|min:1',
        ]);

        $portfolio = Portfolio::where('account_number', $user->account_number)
            ->where('stock_id', $request->stock_id)
            ->first();

        if (!$portfolio) {
            return response()->json(['error' => 'Stock not found in portfolio'], 404);
        }

        if ($portfolio->quantity < $request->quantity) {
            return response()->json(['error' => 'Insufficient stock quantity'], 400);
        }

        $portfolio->quantity -= $request->quantity;

        if ($portfolio->quantity === 0) {
            $portfolio->delete(); // Remove the stock from the portfolio
        } else {
            $portfolio->save();
        }

        return response()->json(['message' => 'Stock sold successfully.']);
    }
}
