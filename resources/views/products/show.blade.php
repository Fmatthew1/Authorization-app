<x-app-layout>
    <div>
        <h1>Show A Single Product</h1>
        <div class="flex flex-col justify-center items-center">
            <button><a href="{{ route('products.index') }}" class="bg-blue-600 px-4 py-2 text-white rounded">Product Page</a></button>
            <div>
                <h2>{{ $product->name }}</h2>
                <p>Status: {{ $product->status->name }}</p>
                @if ($product->status === 'pending' && auth()->user()->id === $product->created_by)
                <form method="POST" action="{{ route('products.forward', $product->id) }}">
                    @csrf
                    <button type="submit" class="inline-flex bg-blue-500 ml-2 px-3 py-2 text-white rounded">Forward Product</button>
                </form>
                @endif

                @if ($product->status === 'forwarded' && auth()->user()->role === 'project_manager')
                <a href="{{ route('products.confirm.page', $product->id) }}" class="inline-flex bg-green-500 ml-2 px-3 py-2 text-white rounded">Confirm Product</a>
                @endif
            </div>
        {{-- </div>
            <p>{{ $product->name }}</p>
            <p>{{ $product->description }}</p>
            <p>{{ $product->price }}</p>
            <p>{{ $product->quantity }}</p>
        </div> --}}
</x-app-layout>