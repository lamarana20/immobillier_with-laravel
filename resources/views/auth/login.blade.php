@extends('base')
@section('title', 'Login')
@section('content')
<div class="container mt-4">
    <h1>Login</h1>
    @include('shared.flash')
    <form action="{{ route('doLogin') }}" method="POST" class="vstack gap-2">
        @csrf
 @include('shared.input', ['type' => 'email', 'name' => 'email', 'label' => 'Email', 'value' => old('email')])
 @include('shared.input', ['type' => 'password', 'name' => 'password', 'label' => 'Password', 'value' => old('password')])
<div>
    <button type="submit" class="btn btn-primary">Login</button>
</div>
</div>

@endsection