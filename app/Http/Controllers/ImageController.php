<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ImageController extends Controller
{
    public function index()
    {
        return Image::with('property')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Stocker l'image
        $path = $request->file('image')->store('images', 'public');

        // Créer l'entrée en base de données
        $image = Image::create([
            'property_id' => $request->property_id,
            'url' => $path,
        ]);

        return response()->json($image, 201);
    }

    public function show(Image $image)
    {
        return $image->load('property');
    }

    public function update(Request $request, Image $image)
    {
        $image->update($request->all());
        return response()->json($image);
    }

    public function destroy(Image $image)
    {
        $image->delete();
        return response()->json(['message' => 'Image supprimée avec succès.']);
    }
}
