<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Details') }}
        </h2>
    </x-slot>

    <button>
        <a href="{{ route('users.index') }}">Users list</a>
    </button>

    <p><strong>Name:</strong> {{$user -> name}}</p>
    <p><strong>Email:</strong> {{$user -> email}}</p>

    <p><strong>Actions:</strong></p>

    <button>
        <a href="{{ route('users.edit', $user) }}">Edit</a>
    </button>

    <form action="{{ route('users.destroy', $user) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="button" onclick="confirmDelete()">Delete User</button>
    </form>

    <script>
        function confirmDelete() {
            if (window.confirm('Are you sure you want to delete this user?')) {
                // If user confirms, submit the form
                document.querySelector('form').submit();
            }
        }
    </script>
</x-app-layout>

