<x-app-layout>

    <div >
        <h1 class="text-left font-bold text-3xl mt-5">Product List</h1>
        <a href="{{ route('products.create') }}" class="text-left font-bold text-xl mt-5 mx-px">Add New Product</a>

        <table class="min-w-full bg-white shadow-md rounded">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Name</th>
                    <th class="py-3 px-6 text-left">Description</th>
                    <th class="py-3 px-6 text-left">Price</th>
                    <th class="py-3 px-6 text-left">quantity</th>
                    <th class="py-3 px-6 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach ($products as $product)
                    <tr>
                        <td class="py-3 px-6 text-left">{{ $product->name }}</td>
                        <td class="py-3 px-6 text-left">{{ $product->description }}</td>
                        <td class="py-3 px-6 text-left">{{ $product->price }}</td>
                        <td class="py-3 px-6 text-left">{{ $product->quantity }}</td>
                        <td class="py-3 px-6 text-left">
                            
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button><a href="{{ route('products.show', $product->id) }}" class="bg-blue-500 px-4 py-2 text-white rounded">View</a></button>
                                <button><a href="{{ route('products.update', $product->id) }}" class="bg-yellow-500 px-4 py-2 text-white rounded">Edit</a></button>
                                <button type="submit" class="bg-red-500 px-4 py-2 text-white rounded">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
