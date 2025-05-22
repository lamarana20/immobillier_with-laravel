@extends('base')
@section('title', $property->title)

@section('content')
<div class="container mt-5">
    <h1>{{ $property->title }}</h1>
    <h2>{{ $property->rooms }} rooms - {{ $property->surface }} m²</h2>
    <div class="text-primary fw-bold" style="font-size:3rem;">
        {{ number_format($property->price, 0, ',', ' ') }}$
    </div>

    <div class="row mt-4">
        {{-- Left image --}}
        <div class="col-md-6">
            @if($property->cover_image)
                <img src="{{ asset('storage/' . $property->cover_image) }}" 
                     alt="Cover image" 
                     class="img-fluid rounded-4 w-100 mb-3" 
                     style="object-fit: cover; max-height: 400px;">
            @else
                <img src="{{ asset('images/placeholder.jpg') }}" 
                     alt="Image not available" 
                     class="img-fluid rounded-4 w-100 mb-3" 
                     style="object-fit: cover; max-height: 400px;">
            @endif
        </div>

        {{-- Right form --}}
        <div class="col-md-6">
            <h4>Interested in this property</h4>
            @include('shared.flash')
            <form action="{{ route('property.contact', $property) }}" method="post" class="vstack gap-3">
                @csrf
                <div class="row">
                    @include('shared.input',['class'=>'col','name'=>'first-name','label'=>'First name'])
                    @include('shared.input',['class'=>'col','name'=>'last-name','label'=>'Last name'])
                </div>
                <div class="row">
                    @include('shared.input',['class'=>'col','name'=>'phone','label'=>'Phone'])
                    @include('shared.input',['type'=>'email','class'=>'col','name'=>'email','label'=>'Email'])
                </div>
                @include('shared.input',['type'=>'textarea','class'=>'col','name'=>'message','label'=>'Your message'])
                <div>
                    <button class="btn btn-primary">Contact us</button>
                </div>
            </form>
        </div>
    </div>

    <hr class="my-5">

    {{-- Description and characteristics below --}}
    <div class="mt-4">
        <h2>Description</h2>
        <p>{!! nl2br($property->description) !!}</p>

        <div class="row mt-4">
            {{-- Characteristics --}}
            <div class="col-md-8">
                <h2>Characteristics</h2>
                <table class="table table-striped">
                    <tr>
                        <td>Living space</td>
                        <td>{{ $property->surface }}m²</td>
                    </tr>
                    <tr>
                        <td>Rooms</td>
                        <td>{{ $property->rooms }}</td>
                    </tr>
                    <tr>
                        <td>Bedrooms</td>
                        <td>{{ $property->bedrooms }}</td>
                    </tr>
                    <tr>
                        <td>Floor</td>
                        <td>{{ $property->floor ?: 'Ground floor' }}</td>
                    </tr>
                    <tr>
                        <td>Location</td>
                        <td>{{ $property->address }} {{ $property->city }} ({{ $property->postal_code }})</td>
                    </tr>
                </table>
            </div>

            {{-- Options --}}
            <div class="col-md-4">
                <div class="card shadow-sm rounded-4">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Features</h5>
                        @if ($property->options->isNotEmpty())
                            <ul class="list-group list-group-flush">
                                @foreach ($property->options as $option)
                                    <li class="list-group-item">{{ $option->name }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted">No features specified.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection