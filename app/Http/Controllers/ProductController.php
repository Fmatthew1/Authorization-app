<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Status;
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
        //dd(auth()->user());
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
        $statuses = Status::all();
        return view('products.show', compact('product', 'statuses'));
        //return view('products.show', ['products' => $product]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)

    {
        //$product = Product::findOrFail($id);
        Gate::authorize('update', $product);
       
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
            'status_id' => 'required|exists:statuses,id',
        ]);
        //$product = Product::findOrFail($id);
        $product->update($request->only('name', 'status_id'));
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
    public function destroy(Request $request, Product $product)
    {
        Gate::authorize('delete', $product);
        //$product = Product::findOrFail($id);
        $product->delete();
    
        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }

    public function forward(Product $product)
{
    $product->update(['status_id' => 2]); // Forwarded status ID from the statuses table

    return redirect()->route('products.index', $product->id)
                     ->with('success', 'Product status updated to Forwarded.');
}


    public function confirm(Product $product)
{
    $product->update(['status_id' => 3]); // Confirmed status ID from the statuses table

    return redirect()->route('products.index', $product->id)
                     ->with('success', 'Product status updated to Confirmed.');
}

    
   
}
