@extends('base')
@section('title', 'All properties')
@section('content')


    <div class="bg-light p-5 mb-5 text-center">
        <form action="" method="get" class="container d-flex gap-2">
            <input type="number" placeholder="Minimum surface" class="form-control" name="surface"
                value="{{ $input['surface'] ?? '' }}">
            <input type="number" placeholder="Minimum rooms" class="form-control" name="rooms"
                value="{{ $input['rooms'] ?? '' }}">
            <input type="number" placeholder="Maximum budget" class="form-control" name="price"
                value="{{ $input['price'] ?? '' }}">
        <input placeholder="Ville" class="form-control" name="city" value="{{ $input['city'] ?? '' }}">

            <button class="btn btn-primary btn-sm flex-grow-0">Search</button>

        </form>



    </div>
    <div class="container">
        <div class="row">
            @forelse($properties as $property)
                <div class="col-3 mb-4">
                    @include('property.card')
                </div>
            @empty

                <div class="col">
                    No properties match your search
                </div>
            @endforelse
        </div>
        <div class=" my-4">
            {{ $properties->links() }}

        </div>
    </div>

@endsection