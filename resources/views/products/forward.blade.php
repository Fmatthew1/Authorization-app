<x-app-layout>

    <h2>Forward Product: {{ $product->name }}</h2>
    <form method="POST" action="{{ route('products.forward', $product->id) }}">
        @csrf
        <button type="submit" class="inline-flex bg-blue-500 ml-2 px-3 py-2 text-white rounded">Forward Product</button>
    </form>

</x-app-layout>