<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()

    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:products|max:255',
            'description' => 'required|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
        ]);

        Product::create($request->all());
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
  */
    public function show($id)
    {
        
        $product = Product::findOrFail($id);
        return view('products.show', ['products' => $product]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)

    {
        //$product = Product::findOrFail($id);
       // Gate::authorize('update', $product);
       
        return view('products.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        Gate::authorize('update', $product);
        request()->validate([
            'name' => 'required',
            'description' => 'required|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
        ]);
        //$product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->save();
    
        return redirect()->route('products.index')
                        ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id, Product $product)
    {
        Gate::authorize('delete', $product);
        $product = Product::findOrFail($id);
        $product->delete();
    
        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }
}
