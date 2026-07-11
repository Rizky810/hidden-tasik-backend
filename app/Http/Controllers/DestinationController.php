<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index()
    {
        return response()->json(Destination::all());
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('image_url')) {
            $data['image_url'] = $request->file('image_url')->store('destinations', 'public');
        }
        $item = Destination::create($data);
        return response()->json($item, 201);
    }

    public function show($id)
    {
        $item = Destination::find($id);
        if (!$item) return response()->json(['message' => 'Not Found'], 404);
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $item = Destination::find($id);
        if (!$item) return response()->json(['message' => 'Not Found'], 404);
        
        $data = $request->all();
        if ($request->hasFile('image_url')) {
            // Hapus gambar lama jika ada
            if ($item->image_url && \Illuminate\Support\Facades\Storage::disk('public')->exists($item->image_url)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($item->image_url);
            }
            $data['image_url'] = $request->file('image_url')->store('destinations', 'public');
        }
        
        $item->update($data);
        return response()->json($item);
    }

    public function destroy($id)
    {
        $item = Destination::find($id);
        if (!$item) return response()->json(['message' => 'Not Found'], 404);
        
        if ($item->image_url && \Illuminate\Support\Facades\Storage::disk('public')->exists($item->image_url)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($item->image_url);
        }
        
        $item->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
