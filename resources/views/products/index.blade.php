<x-app-layout>

    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-semibold mb-6">Product List</h1>
        @can('create', App\Models\Product::class)
        <button><a href="{{ route('products.create') }}" class="bg-blue-500 px-4 py-2 text-white rounded text-left font-bold text-xl mt-5 mx-px">Add New Products</a>
        </button>
        @endcan
    
        <table class="min-w-full bg-white shadow-md rounded">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-2 px-3 text-left">#</th>
                    <th class="py-2 px-3 text-left">Name</th>
                    <th class="py-2 px-3 text-left">Description</th>
                    <th class="py-2 px-3 text-left">Price</th>
                    <th class="py-2 px-3 text-center">Quantity</th>
                    <th class="py-2 px-3 text-center">Created By</th>
                    <th class="py-2 px-3 text-center">Confirmed By</th>
                    <th class="py-2 px-3 text-center">Status</th>
                    <th class="py-2 px-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach($products as $product)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap">{{ $loop->index + 1 }}</td>
                        <td class="py-3 px-6 text-left">{{ $product->name }}</td>
                        <td class="py-3 px-6 text-left">{{ $product->description }}</td>
                        <td class="py-3 px-6 text-left">{{ $product->price }}</td>
                        <td class="py-3 px-6 text-left">{{ $product->quantity }}</td>
                        <td class="py-3 px-6 text-left">{{ $product->creator->name }}</td>
                        <?php $confirmedUser = $product->confirmedBy; ?>
                        <td class="py-3 px-6 text-left">{{ $confirmedUser ? $confirmedUser->name : 'Not Confirmed' }}</td>
                        <td class="py-3 px-6 text-left">{{ $product->status->name }}</td>
                        <td class="py-2 px-4 text-center">
                            <div class="flex item-center justify-center">
                                @can('forward', $product)
                                <form action="{{ route('products.forward', $product->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="inline-flex bg-gray-500 text-white px-3 py-2 rounded">
                                        Forwarded
                                    </button>
                                </form>
                                @endcan     
                                @can('confirm', $product)
                                <form action="{{ route('products.confirm', $product->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="inline-flex bg-green-500 text-white px-3 py-2 rounded">
                                        Confirmed
                                    </button>
                                </form>
                                @endcan                 
                                <a href="{{ route('products.show', $product->id) }}" class="inline-flex bg-blue-500 px-3 py-2 text-white rounded">
                                    View
                                </a>
                                @can('update', $product)
                                <a href="{{ route('products.edit', $product->id) }}" class="inline-flex bg-yellow-500 ml-2 px-3 py-2 text-white rounded">
                                    Edit
                                </a>
                                @endcan
                                @can('delete', $product)
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex bg-red-500 ml-2 px-3 py-2 text-white rounded">
                                        Delete
                                    </button>
                                </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
