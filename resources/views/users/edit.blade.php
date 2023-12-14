<x-app-layout>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Update User') }}
        </h2>
    </x-slot>

    <div class="py-12 px-12">
        <div class="max-w-7xl m-auto sm:px-6 lg:px-8 flex items-center justify-center">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-2/5  min-h-[250px]">
                <div class="p-2">
                    <button class="default-button w-2/7">
                        <a href="{{ route('users.show', $user) }}">&larr; User Details</a>
                    </button>
                </div>

                <form method="POST" action="{{ route('users.update', $user) }}">
                    @csrf
                    @method('PUT')
                    <div class="py-4 px-16 flex flex-col justify-items-center">
                        <div class="p-2 form-group">
                            <label for="name">Name</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name') ?? $user->name }}">
                        </div>

                        <div class="p-2 form-group">
                            <label for="email">Email</label>
                            <input class="form-control " type="email" name="email" id="email" value="{{ old('email') ?? $user->email }}">
                        </div>

                        <div class="p-2 form-group">
                            <label for="password">Password</label>
                            <input class="form-control" type="password" name="password" id="password">
                        </div>
                    </div>

                    <div class="pb-6 pt-2 flex justify-center">
                        <button class="edit-button" type="submit">Update User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
