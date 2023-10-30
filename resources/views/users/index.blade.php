@extends('layouts.users')

@section('routeName', 'index')

@section('content')
    <h2>Users</h2>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Details</th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td><a href="{{ route('users.show', $user) }}">Details</a></td>
            </tr>
        @endforeach
    </table>

    {{ $users->links() }}
@endsection


