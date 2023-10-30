@extends('layouts.app')

@section('title', 'Customers')

<body>
@section('sidebar')
   <h1> Users - @yield('routeName') route. </h1>
@show

<div class="container">
    @yield('content')
</div>
</body>
