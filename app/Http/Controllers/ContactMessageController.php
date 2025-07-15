<?php
namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index()
    {
        return ContactMessage::with('property')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string',
            'email' => 'required|email',
            'telephone' => 'nullable|string',
            'message' => 'required|string',
            'property_id' => 'nullable|exists:properties,id',
        ]);

        return ContactMessage::create($validated);
    }

    public function show(ContactMessage $contactMessage)
    {
        return $contactMessage->load('property');
    }

    public function update(Request $request, ContactMessage $contactMessage)
    {
        $contactMessage->update($request->all());
        return response()->json($contactMessage);
    }

    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();
        return response()->json(['message' => 'Message supprimé avec succès.']);
    }
}
