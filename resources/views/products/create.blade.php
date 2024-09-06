<x-app-layout>
            <h2 class="text-left font-bold text-3xl mt-5">Create Products</h2>
            @if ($errors->any())
        
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
            @endif
                
            <div class="flex flex-col justify-center items-center">
                <div class="font-normal md:font-bold text-lg mt-5">Create New Product</div>

                <div class="mt-5 w-[50%] ">
                    <form method="POST" action="{{ route('products.store') }}">
                    @csrf
                        <div class="flex flex-col justify-center items-center w-full space-y-4">
                            <div class="w-full">
                                <label for="name" class="">Product Name</label>
                                <input id="name" type="text" class=" w-full @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
                            </div>
                            
                            <div class="w-full">
                                <label for="description" class="">Description</label>
                                <input id="description" type="text" class=" w-full @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}">
                            </div>
                            <div class="w-full">
                                <label for="name" class="">Price</label>
                                <input id="price" type="number" class=" w-full @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}">
                            </div>
                            <div class="w-full">
                                <label for="quantity" class="">Quantity</label>
                                <input id="quantity" type="number" class=" w-full @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') }}">
                            </div>
                            <button type="submit" class="bg-green-600 px-6 py-2 mt-4 w-1/2 text-white rounded">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
</x-app-layout>

