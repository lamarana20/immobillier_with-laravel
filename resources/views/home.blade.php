@extends('base')

@section('content')
    <div class="bg-light p-5 mb-5 text-center">
        <div class="container">
            <h1>MLD Agency</h1>
            <p>
                At <strong>MLD Agency</strong>, we understand that finding your dream home or selling your property is an important step in your life.
                Our team of dedicated professionals is here to guide you through every step of the process, offering personalized service and expert advice.
            </p>
            <p class="text-muted fst-italic">
                English support available — we're here with good vibes and even better service. 🌟
            </p>
        </div>
    </div>

    <div class="container">
        <h2 class="mb-4">Our latest properties</h2>
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
    @foreach($properties as $property)
        <div class="col">
            @include('property.card')
        </div>
    @endforeach
</div>

    </div>
@endsection