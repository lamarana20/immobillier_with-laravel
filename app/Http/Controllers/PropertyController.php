<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropertyContact;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Option;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PropertyFormRequest;
use App\Http\Requests\SearchPropertiesRequest;
use App\Mail\PropertyMail;
use Illuminate\Support\Facades\Mail;

class PropertyController extends Controller
{
    public function index()
    {
        return view('admin.properties.index', [
            'properties' => Property::orderBy('created_at', 'desc')->paginate(25),
        ]);
    }

    public function create()
    {
        $property = new Property();
        $property->fill([
            'title' => 'Appartement à vendre',
            'description' => 'Un bel appartement à vendre dans le centre-ville.',
            'price' => 250000,
            'surface' => 40,
            'rooms' => 3,
            'bedrooms' => 1,
            'floor' => 0,
            'city' => 'New York',
            'postal_code' => 12065,
            'sold' => false,
        ]);

        return view('admin.properties.form', [
            'property' => $property,
            'options' => Option::pluck('name', 'id'),
        ]);
    }

    public function store(PropertyFormRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('cover_image')) {
            $coverPath = $request->file('cover_image')->store('properties/cover', 'public');
            $data['cover_image'] = $coverPath;
        }

        $property = Property::create($data);
        $property->options()->sync($request->validated('options', []));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                if (!$image->isValid()) {
                    return back()->withErrors(['images' => 'Une des images est invalide : ' . $image->getErrorMessage()]);
                }

                $path = $image->store('properties', 'public');
                $property->images()->create(['path' => $path]);
            }
        }

        return redirect()
            ->route('admin.property.index')
            ->with('success', 'La propriété a été créée avec succès.');
    }

    public function edit(Property $property)
    {
        return view('admin.properties.form', [
            'property' => $property,
            'options' => Option::pluck('name', 'id'),
        ]);
    }

    public function update(propertyFormRequest $request, Property $property)
    {
        $data = $request->validated();

        // Nouvelle image de couverture
        if ($request->hasFile('cover_image')) {
            $coverPath = $request->file('cover_image')->store('properties/cover', 'public');
            $data['cover_image'] = $coverPath;

            // Supprimer l’ancienne image de couverture
            if ($property->cover_image) {
                Storage::disk('public')->delete($property->cover_image);
            }
        }

        $property->update($data);
        $property->options()->sync($request->validated('options', []));

        // Ajouter de nouvelles images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                if (!$image->isValid()) {
                    return back()->withErrors(['images' => 'Une des images est invalide : ' . $image->getErrorMessage()]);
                }

                $path = $image->store('properties', 'public');
                $property->images()->create(['path' => $path]);
            }
        }

        return redirect()
            ->route('admin.property.index')
            ->with('success', 'La propriété a été mise à jour avec succès.');
    }

    public function destroy(Property $property)
    {
        // Supprimer les images associées
        foreach ($property->images as $image) {
            Storage::disk('public')->delete($image->path);
            $image->delete();
        }

        // Supprimer l’image de couverture
        if ($property->cover_image) {
            Storage::disk('public')->delete($property->cover_image);
        }

        $property->delete();

        return redirect()
            ->route('admin.property.index')
            ->with('success', 'La propriété a été supprimée avec succès.');
    }
//
   public function Doindex(SearchPropertiesRequest $request)
    {
        $query = Property::query()->orderBy('created_at', 'desc');

        if ($price = $request->validated('price')) {
            $query->where('price', '<=', $price);
        }

        if ($surface = $request->validated('surface')) {
            $query->where('surface', '>=', $surface); 
        }

        if ($rooms = $request->validated('rooms')) {
            $query->where('rooms', '>=', $rooms); 
        }

       if ($city = $request->validated('city')) {
    $query->where('city', 'like', "%{$city}%");
}


        return view('property.index', [
            'properties' => $query->paginate(16)->withQueryString(),
            'input' => $request->validated()
        ]);
    }

    public function show(string $slug, Property $property)
    {
        $expectedSlug = $property->getSlug();

        if ($slug !== $expectedSlug) {
            return to_route('property.show', [
                'slug' => $expectedSlug,
                'property' => $property
            ]);
        }

        return view('property.show', [
            'property' => $property
        ]);
    }
    
    public function contact (PropertyContact $request, Property $property)
  {
    
    
    Mail::send(new PropertyMail($property, $request->validated()));
    return back()->with('success', 'Votre message a été envoyé');
}

   
    
}

