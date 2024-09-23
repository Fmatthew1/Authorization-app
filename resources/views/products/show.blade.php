<x-app-layout>
    <div>
        <h1>Show A Single Product</h1>
        <div class="flex flex-col justify-center items-center">
            <button><a href="{{ route('products.index') }}" class="bg-blue-600 px-4 py-2 text-white rounded">Product Page</a></button>
            <div>
                <h2>{{ $product->name }}</h2>
                <p>Status: {{ $product->status->name }}</p>
                {{-- <p>Status: {{ $product->status }}</p>
                <p>Created By: {{ $product->creator->name ?? 'N/A' }}</p>
                <p>Confirmed By: {{ $product->confirmer->name ?? 'Not confirmed yet' }}</p> --}}
            </div>
        {{-- </div>
            <p>{{ $product->name }}</p>
            <p>{{ $product->description }}</p>
            <p>{{ $product->price }}</p>
            <p>{{ $product->quantity }}</p>
        </div> --}}
</x-app-layout>