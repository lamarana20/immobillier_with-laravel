<div class="card shadow-sm h-100 border-0 rounded-4 overflow-hidden position-relative">
    {{-- Badge "Vendu" --}}
    @if($property->sold)
        <span class="badge bg-danger position-absolute top-0 start-0 m-2">Vendu</span>
    @endif

    {{-- Image principale --}}
{{-- Image principale --}}
<div class="ratio ratio-16x9 bg-light position-relative">
    @if($property->cover_image)
        <img src="{{ asset('storage/' . $property->cover_image) }}" 
             alt="Image de couverture" 
             class="w-100 h-100 object-fit-cover">
    @else
        <img src="{{ asset('images/placeholder.jpg') }}" 
             alt="Aucune image disponible" 
             class="w-100 h-100 object-fit-cover">
    @endif
</div>


    <div class="card-body d-flex flex-column">
        {{-- Titre --}}
        <h5 class="card-title mb-1">
            <a href="{{ route('property.show', ['slug' => $property->getslug(), 'property' => $property]) }}"
               class="text-decoration-none text-dark stretched-link">
                {{ $property->title }}
            </a>
        </h5>


        {{-- Localisation --}}
        <p class="text-muted mb-2 small">
            <i class="bi bi-geo-alt-fill me-1 text-primary"></i>
            {{ $property->city }} ({{ $property->postal_code }})
        </p>
        {{-- bederoom --}}
        <p class="text-muted mb-2 small">
    <i class="bi bi-house-door-fill me-1 text-primary"></i>
    {{ $property->bedrooms }} {{ Str::plural('Bedrooms', $property->bedrooms) }}
</p>

        {{-- Surface --}}
        <p class="mb-2 small">
            <i class="bi bi-aspect-ratio-fill me-1 text-secondary"></i>
            {{ $property->surface }} m²
        </p>

        {{-- Prix --}}
        <div class="mt-auto text-primary fw-bold fs-5">
            {{ number_format($property->price, 0, ',', ' ') }} $
        </div>
    </div>
</div>
