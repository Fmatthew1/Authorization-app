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
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Product $product)
    {
       
        Gate::authorize('create', $product);
        return view('products.create');
        
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Product $product)
    {
        //Gate::authorize('create', $product);
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

    public function forward(Product $product) {
        Gate::authorize('forward', $product);
        //$product = Product::findOrFail($id);
        $forward_status = Status::where('name', 'Forwarded')->first();
        $product->update(['status_id' => $forward_status->id]);
        
        return redirect()->back()->with('status', 'Product forwarded successfully');
    }
    
    public function confirm(Product $product) {
    
        Gate::authorize('confirm', $product);
        //$product = Product::findOrFail($id);
        $confirmed_status = Status::where('name', 'Confirmed')->first();
        $product->update(['status_id' => $confirmed_status->id]);
        $product->save();
        return redirect()->back()->with('status', 'Product confirmed successfully');
    }

    
   
}
