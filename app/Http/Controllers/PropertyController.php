<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index()
    {
        return Property::with('images')->get();
    }

 public function store(Request $request)
{
    $validated = $request->validate([
        'titre' => 'required|string',
        'description' => 'nullable|string',
        'prix' => 'required|numeric',
        'surface' => 'required|numeric',
        'localisation' => 'required|string',
        'statut' => 'nullable|string',
        'type' => 'required|string',
        'pieces' => 'nullable|integer',
        'images.*' => 'nullable|image|max:2048', // validation pour chaque image
    ]);

    // Création de la propriété
    $property = Property::create($validated);

    // Si des images sont envoyées, on les traite
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $imageFile) {
            // Stocker l'image dans le dossier 'public/properties'
            $path = $imageFile->store('properties', 'public');

            // Créer l'enregistrement image lié à la propriété
            $property->images()->create(['url' => $path]);
        }
    }

    // Retourner la propriété avec les images chargées
    return response()->json($property->load('images'), 201);
}


    public function show(Property $property)
    {
        return $property->load('images');
    }

    public function update(Request $request, Property $property)
    {
        $property->update($request->all());
        return response()->json($property);
    }

    public function destroy(Property $property)
    {
        $property->delete();
        return response()->json(['message' => 'Bien supprimé avec succès.']);
    }
}
