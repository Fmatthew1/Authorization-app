<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-semibold mb-6">All Roles</h1>
        <button><a href="{{ route('roles.create') }}" class="bg-blue-500 px-4 py-2 text-white rounded text-left font-bold text-xl mt-5 mx-px">Add New Role</a></button>
        <table class="min-w-full bg-white shadow-md rounded">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">#</th>
                    <th class="py-3 px-6 text-left">Role Name</th>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach($roles as $role)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap">{{ $loop->index + 1 }}</td>
                        <td class="py-3 px-6 text-left">{{ $role->name }}</td>
                        <td class="py-3 px-6 text-center"> 
                            <div class="flex item-center justify-center">
                                <a href="{{ route('roles.show', $role->id) }}" class="bg-blue-500 px-4 py-2 text-white rounded">
                                    View
                                </a>
                                <a href="{{ route('roles.edit', $role->id) }}" class="bg-yellow-500 ml-2 px-4 py-2 text-white rounded">
                                    Edit
                                </a>
                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 ml-2 px-4 py-2 text-white rounded">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
