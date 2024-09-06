<x-app-layout>
    <div>
        <h1>Show A Single Product</h1>
        <div class="flex flex-col justify-center items-center">
            <button><a href="{{ route('products.index') }}" class="bg-blue-600 px-4 py-2 text-white rounded">Product Page</a></button>
        </div>
            <p>{{ $product->name }}</p>
            <p>{{ $product->description }}</p>
            <p>{{ $product->price }}</p>
            <p>{{ $product->quantity }}</p>
    </div>
</x-app-layout>