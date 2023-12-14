<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl m-auto sm:px-6 lg:px-8 flex justify-center">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-screen">
                <div class="py-4 px-8 flex justify-between items-center">
                    <h1>Users List</h1>

                    <button class="action-button">
                        <a href="{{ route('users.create') }}">Create User</a>
                    </button>
                </div>

                @if(request()->query('limit') >= 20)
                    {{ $users->links() }}
                @endif

                <div class="p-2 h-screen">
                    <table class="default-table mx-auto w-full rounded outline outline-1">
                        <thead>
                        <tr class="text-center align-middle bg-gray-400 rounded">
                            <th class="users-table-cell w-2/5">Name</th>
                            <th class="users-table-cell w-3/5">Email</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($users as $user)
                            <tr class="text-center align-middle">
                                <td class="users-table-cell w-2/5">
                                    <button  class="underline-text-button">
                                        <a href="{{ route('users.show', $user) }}">{{ $user->name }}</a>
                                    </button>
                                </td>
                                <td class="users-table-cell w-3/5">{{ $user->email }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="p-2">
                        {{ $users->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
