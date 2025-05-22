@extends('base')

@section('content')
    <div class="bg-light p-5 mb-5 text-center">
        <div class="container">
            <h1>Agence MLD</h1>
            <p>
                Chez <strong>Agence MLD</strong>, nous comprenons que trouver la maison de vos rêves ou vendre votre propriété est une étape importante de votre vie.
                Notre équipe de professionnels dévoués est là pour vous accompagner à chaque étape du processus, en vous offrant un service personnalisé et des conseils d'experts.
            </p>
            <p class="text-muted fst-italic">
                English support available — we're here with good vibes and even better service. 🌟
            </p>
        </div>
    </div>

    <div class="container">
        <h2 class="mb-4">Nos derniers biens</h2>
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
    @foreach($properties as $property)
        <div class="col">
            @include('property.card')
        </div>
    @endforeach
</div>

    </div>
@endsection
