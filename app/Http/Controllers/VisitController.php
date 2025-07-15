<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function index()
    {
        return Visit::with(['user', 'property'])->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'property_id' => 'required|exists:properties,id',
            'date_visite' => 'required|date',
            'heure_visite' => 'required|date_format:H:i',
            'statut' => 'nullable|string',
        ]);

        return Visit::create($validated);
    }

    public function show(Visit $visit)
    {
        return $visit->load(['user', 'property']);
    }

    public function update(Request $request, Visit $visit)
    {
        $visit->update($request->all());
        return response()->json($visit);
    }

    public function destroy(Visit $visit)
    {
        $visit->delete();
        return response()->json(['message' => 'Visite supprimée avec succès.']);
    }
}
