<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Orders/Index', [
            'orders' => Order::with('products'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Orders/Create', [
            'products' => Product::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        $totalPrice = $this->calculateTotalPrice($request);
    
        $order = Order::create([
            'total_price' => $totalPrice
        ]);
    
        foreach ($validated['products'] as $productData) {
            $product = Product::findOrFail($productData['id']);
            $order->products()->attach($product, ['quantity' => $productData['quantity']]);
        }
    
        return response()->json(['message' => 'Order created successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function calculateTotalPrice(Request $request){

        $totalPrice = 0;
        foreach ($request->products as $productData) {
            
            $product = Product::findOrFail($productData['id']);
            $totalPrice += $product->calculate($productData['quantity']);
        }

        return response()->json(['totalPrice' => $totalPrice]);
    }
}
