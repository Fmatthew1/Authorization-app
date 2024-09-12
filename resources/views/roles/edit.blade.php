<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-semibold mb-6">Edit Role</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            </div>
        @endif
        <form action="{{ route('roles.update', $role->id) }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Role Name</label>
                <select id="role" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    <option value="admin" {{ $role->name == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ $role->name == 'user' ? 'selected' : '' }}>User</option>
                    <option value="project manager" {{ $role->name == 'project manager' ? 'selected' : '' }}>Project Manager</option>
                    <option value="editor" {{ $role->name == 'editor' ? 'selected' : '' }}>Editor</option>
                </select>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Update Role
                </button>
            </div>
        </form>
    </div>

</x-app-layout>
