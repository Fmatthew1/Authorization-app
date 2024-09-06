<x-app-layout>
        <h2 class="text-left font-bold text-3xl mt-5">Edit Products</h2>
        @if ($errors->any())
        
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            
        @endif
        <div class="flex flex-col justify-center items-center">
           <button><a href="{{ route('products.index') }}" class="bg-blue-600 px-4 py-2 text-white rounded"> Back</a></button>
        </div>
                <div class="font-normal md:font-bold text-lg mt-5">Update Products</div>
                <div class="mt-5 w-[50%]">
                    <form method="POST" action="/products/{{ $product->id }}">
                    @csrf
                    @method('PUT')
                    <div class="flex flex-col justify-center items-center w-full space-y-4">
                            <div class="w-full">
                                <label for="name" class="">Name</label>
                                <input id="name" type="text" class=" w-full @error('name') is-invalid @enderror" name="name" value="{{ $product->name}}">
                            </div>
                            <div class="w-full">
                                <label for="description" class="">description</label>
                                <input id="description" type="text" class=" w-full @error('description') is-invalid @enderror" name="description" value="{{ $product->description}}">
                            </div>
                            <div class="w-full">
                                <label for="name" class="">Price</label>
                                <input id="price" type="number" class=" w-full @error('price') is-invalid @enderror" name="price" value="{{ $product->price}}">
                            </div>
                            <div class="w-full">
                                <label for="name" class="">Quantity</label>
                                <input id="quantity" type="number" class=" w-full @error('quantity') is-invalid @enderror" name="quantity" value="{{ $product->quantity}}">
                            </div>
                            <div class="w-full">
                                <button type="submit" class="bg-green-600 px-4 py-2 rounded w-1/2">
                                    Update Product
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                </div>
</x-app-layout>