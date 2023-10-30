@extends('layouts.users')

@section('routeName', 'show')

@section('content')
    <h2>User Details</h2>

    <p><strong>Name:</strong> {{$user -> name}}</p>
    <p><strong>Email:</strong> {{$user -> email}}</p>
@endsection


