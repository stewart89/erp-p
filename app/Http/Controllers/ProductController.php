<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Products/Index', [
            'products' => Product::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Products/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|integer|min:5',
            'three_pack_price' => 'required|integer|min:5',
            'five_pack_price' => 'required|integer|min:5',
        ]);

        Product::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'three_pack_price' => $validated['three_pack_price'],
            'five_pack_price' => $validated['five_pack_price'],
        ]);

        return redirect()->route('products')->with('success', 'Product created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return Inertia::render('Products/Edit', [
            'product' => Product::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|integer|min:5',
            'three_pack_price' => 'required|integer|min:5',
            'five_pack_price' => 'required|integer|min:5',
        ]);

        $product = Product::find($id);
        $product->name = $validated['name'];
        $product->price = $validated['price'];
        $product->three_pack_price = $validated['three_pack_price'];
        $product->five_pack_price = $validated['five_pack_price'];
        $product->save();

        return redirect()->route('products')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Product::destroy($id)){
            return redirect()->route('products')->with('success', 'Product deleted successfully!');
        }
    }
}
