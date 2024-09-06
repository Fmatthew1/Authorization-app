<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-semibold mb-6">User Details</h1>
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <ul class="list-none">
                <li class="mb-2"><strong>ID:</strong> {{ $user->id }}</li>
                <li class="mb-2"><strong>Name:</strong> {{ $user->name }}</li>
                <li class="mb-2"><strong>Email:</strong> {{ $user->email }}</li>
                <li class="mb-2"><strong>Role:</strong> {{ $user->role }}</li>
                <li class="mb-2"><strong>Created At:</strong> {{ $user->created_at }}</li>
                <li class="mb-2"><strong>Updated At:</strong> {{ $user->updated_at }}</li>
            </ul>
            <a href="{{ route('users.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mt-4 inline-block">
                Back to List
            </a>
        </div>
    </div>
</x-app-layout>
