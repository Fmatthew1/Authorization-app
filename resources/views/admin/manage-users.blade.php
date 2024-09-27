<!-- resources/views/admin/users.blade.php -->
<x-app-layout>
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Select a User to Make Admin</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 border border-green-200 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-800 border border-red-200 p-4 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    @if($users->isEmpty())
        <p class="text-gray-500">No users available to make admin.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left text-gray-600 uppercase font-semibold">ID</th>
                        <th class="px-4 py-2 text-left text-gray-600 uppercase font-semibold">Name</th>
                        <th class="px-4 py-2 text-left text-gray-600 uppercase font-semibold">Email</th>
                        <th class="px-4 py-2 text-left text-gray-600 uppercase font-semibold">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $user->id }}</td>
                        <td class="px-4 py-2">{{ $user->name }}</td>
                        <td class="px-4 py-2">{{ $user->email }}</td>
                        <td class="px-4 py-2">
                            <form action="{{ route('admin.makeAdmin', $user->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-blue-500 text-white px-3 py-2 rounded hover:bg-blue-600">
                                    Make Admin
                                </button>
                            </form>
                            <form action="{{ route('admin.productManager', $user->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-green-500 text-white px-3 py-2 rounded hover:bg-blue-600">
                                    ProductManager
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
</x-app-layout>
