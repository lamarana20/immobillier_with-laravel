@extends('base')
@section('title', 'Register')
@section('content')
<div class="container mt-4">
    <h1>@yield('title')</h1>
    @include('shared.flash')
    <form action="{{ route('register') }}" method="POST" class="vstack gap-2">
        @csrf
@include('shared.input', ['type' => 'text', 'name' => 'name', 'label' => ' Name', 'value' => old('name')])
 @include('shared.input', ['type' => 'email', 'name' => 'email', 'label' => 'Email', 'value' =>old( 'email') ])
 @include('shared.input', ['type' => 'password', 'name' => 'password', 'label' => 'Password', 'value' => old('password')])
<div>
    <button type="submit" class="btn btn-primary">Login</button>
</div>
</div>

@endsection