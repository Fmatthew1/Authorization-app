<x-app-layout>
    <div>
        <h1 class="text-2xl font-semibold mb-6 px-3 py-2 ">Show A Single Product</h1>
        <div class="flex flex-col justify-center items-center">
            <button><a href="{{ route('products.index') }}" class="bg-blue-600 px-4 py-2 text-white rounded">Product Page</a></button>
           
        <div class="max-w-4xl mx-auto py-6">
            <h2 class="text-2xl font-bold mb-4">Product Details</h2>
            <table class="min-w-full border-collapse block md:table">
                <thead class="block md:table-header-group">
                
                    <th class="py-2 px-3 text-left">Name</th>
                    <th class="py-2 px-3 text-left">Description</th>
                    <th class="py-2 px-3 text-left">Price</th>
                    <th class="py-2 px-3 text-center">Quantity</th>
                    <th class="py-2 px-3 text-center">Status</th>
                    <th class="py-2 px-3 text-center">Actions</th>
                </thead>
                <tbody class="block md:table-row-group">
                    <tr class="border border-gray-300 md:border-none block md:table-row">
            
                        <td class="p-2 text-gray-600 md:table-cell">{{ $product->name }}</td>
        
                        <td class="p-2 text-gray-600 md:table-cell">{{ $product->description }}</td>
                    
                        <td class="p-2 text-gray-600 md:table-cell">{{ $product->price }}</td>
    
                        <td class="p-2 text-gray-600 md:table-cell">{{ $product->quantity }}</td>
                
                        <td class="p-2 text-gray-600 md:table-cell">{{ $product->status->name }}</td>
                        <div class="flex item-center justify-center">
                        <td class="py-2 px-4 text-center">    
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
                    </tr>
                </tbody>
            </table>
        </div>
        
</x-app-layout>