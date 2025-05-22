@extends('admin.admin')
@section('title', $property->exists ? 'Edit property' : 'Create property')
@section('content')
    <h1>@yield('title')</h1>
    <form class="vstack gap-2"
        action="{{ route($property->exists ? 'admin.property.update' : 'admin.property.store', $property) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method($property->exists ? 'put' : 'post')
        <div class="row g-3">
            @include('shared.input', [
                'class' => 'col-md-6',
                'label' => 'Title',
                'name' => 'title',
                'value' => $property->title,
            ])
            <div class="col-md-6 row g-3">
                @include('shared.input', [
                    'class' => 'col-sm-6',
                    'name' => 'surface',
                    'value' => $property->surface,
                ])
                @include('shared.input', [
                    'class' => 'col-sm-6',
                    'name' => 'price',
                    'label' => 'Price',
                    'value' => $property->price,
                ])
            </div>
        </div>
        @include('shared.input', [
            'type' => 'textarea',
            'name' => 'description',
            'label' => 'Description',
            'value' => $property->description,
        ])
        <div class="row g-3">
            @include('shared.input', [
                'class' => 'col-md-4',
                'name' => 'rooms',
                'label' => 'Rooms',
                'value' => $property->rooms,
            ])
            @include('shared.input', [
                'class' => 'col-md-4',
                'name' => 'bedrooms',
                'label' => 'Bedrooms',
                'value' => $property->bedrooms,
            ])
            @include('shared.input', [
                'class' => 'col-md-4',
                'name' => 'floor',
                'label' => 'Floor',
                'value' => $property->floor,
            ])
        </div>
        <div class="row g-3">
            @include('shared.input', [
                'class' => 'col-md-4',
                'name' => 'address',
                'label' => 'Address',
                'value' => $property->address,
            ])
            @include('shared.input', [
                'class' => 'col-md-4',
                'name' => 'city',
                'label' => 'City',
                'value' => $property->city,
            ])
            @include('shared.input', [
                'class' => 'col-md-4',
                'name' => 'postal_code',
                'label' => 'Postal Code',
                'value' => $property->postal_code,
            ])
        </div>
        @include('shared.select', [
            'name' => 'options',
            'label' => 'Options',
            'value' => $property->options()->pluck('id')->toArray(),
            'multiple' => true,
            'options' => $options,
        ])

        @include('shared.checkbox', [
            'name' => 'sold',
            'label' => 'Sold',
            'value' => $property->sold,
        ])
   
    <input type="file" name="cover_image" class="form-control">
{{-- Affichage des images existantes --}}
        @if ($property->exists && $property->images->isNotEmpty())
            <div class="mb-3">
                <label class="form-label">Images existantes</label>
                <div class="row g-2">
                    @foreach ($property->images as $image)
                        <div class="col-md-3 position-relative">
                            <img src="{{ asset('storage/' . $image->path) }}" class="img-fluid rounded shadow-sm mb-1">
                            <form method="POST" action="{{ route('admin.property.image.delete', $image->id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1" type="submit">×</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div>
            <button class="btn btn-primary">
                @if ($property->exists)
                    Update
                @else
                    Create
                @endif
            </button>
        </div>
    </form>
@endsection