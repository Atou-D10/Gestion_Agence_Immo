<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function index()
    {
        return Contract::with(['user', 'property'])->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'property_id' => 'required|exists:properties,id',
            'type' => 'required|string', // location ou vente
            'montant' => 'required|numeric',
            'date_signature' => 'required|date',
            'fichier_pdf' => 'nullable|string',
        ]);

        return Contract::create($validated);
    }

    public function show(Contract $contract)
    {
        return $contract->load(['user', 'property']);
    }

    public function update(Request $request, Contract $contract)
    {
        $contract->update($request->all());
        return response()->json($contract);
    }

    public function destroy(Contract $contract)
    {
        $contract->delete();
        return response()->json(['message' => 'Contrat supprimé avec succès.']);
    }
}
