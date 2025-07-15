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
            'titre' => 'required',
            'description' => 'nullable',
            'prix' => 'required|numeric',
            'surface' => 'required|numeric',
            'localisation' => 'required',
            'statut' => 'nullable|string',
            'type' => 'required|string',
            'pieces' => 'nullable|integer',
        ]);

        $property = Property::create($validated);

        return response()->json($property, 201);
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
