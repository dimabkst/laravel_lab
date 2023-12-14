<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Details') }}
        </h2>
    </x-slot>

    <div class="py-12 px-12">
        <div class="max-w-7xl m-auto sm:px-6 lg:px-8 flex items-center justify-center">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-2/5 relative min-h-[250px]">
                <div class="p-2 flex justify-between items-center">
                    <button class="default-button w-1/5">
                        <a href="{{ route('users.index') }}">&larr; Users list</a>
                    </button>

                    <button class="action-button w-1/5">
                        <a href="{{ route('users.edit', $user) }}">Edit</a>
                    </button>
                </div>

                <div class="p-8 flex items-center justify-center flex-col">
                    <p><strong>Name:</strong> {{$user -> name}}</p>

                    <p><strong>Email:</strong> {{$user -> email}}</p>
                </div>

                <div class="p-2 absolute right-0 bottom-0">
                        <form action="{{ route('users.destroy', $user) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button class="delete-button" type="button" onclick="confirmDelete()">
                                Delete User
                            </button>
                        </form>
                    </div>
                </div>
        </div>
    </div>


    <script>
        function confirmDelete() {
            if (window.confirm('Are you sure you want to delete this user?')) {
                // If user confirms, submit the form
                document.querySelector('form').submit();
            }
        }
    </script>
</x-app-layout>

