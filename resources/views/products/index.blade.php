<x-app-layout>

    <div >
        <h1 class="text-left font-bold text-3xl mt-5">Product List</h1>
        <div class="flex flex-col">
        <button><a href="{{ route('products.create') }}" class="bg-blue-500 mr-4 px-4 py-2 mb-7 text-white text-xl rounded ">Add New Product</a></button>
        </div>

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
                                @can('update', $product)
                                <button><a href="{{ route('products.update', $product->id) }}" class="bg-yellow-500 px-4 py-2 text-white rounded">Edit</a></button>
                                @else 
                                    <p>You do not have permission to edit this product</p>
                                @endcan

                                @can('delete', $product)
                                <button type="submit" class="bg-red-500 px-4 py-2 text-white rounded">Delete</button>
                                @else 
                                <p>You do not have permission to delete this product</p>
                                @endcan
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
