<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    public function index()
    {
        return response()->json(Facility::all());
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('icon_url')) {
            $data['icon_url'] = $request->file('icon_url')->store('facilities', 'public');
        }
        $item = Facility::create($data);
        return response()->json($item, 201);
    }

    public function show($id)
    {
        $item = Facility::find($id);
        if (!$item) return response()->json(['message' => 'Not Found'], 404);
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $item = Facility::find($id);
        if (!$item) return response()->json(['message' => 'Not Found'], 404);
        
        $data = $request->all();
        if ($request->hasFile('icon_url')) {
            if ($item->icon_url && \Illuminate\Support\Facades\Storage::disk('public')->exists($item->icon_url)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($item->icon_url);
            }
            $data['icon_url'] = $request->file('icon_url')->store('facilities', 'public');
        }
        
        $item->update($data);
        return response()->json($item);
    }

    public function destroy($id)
    {
        $item = Facility::find($id);
        if (!$item) return response()->json(['message' => 'Not Found'], 404);
        
        if ($item->icon_url && \Illuminate\Support\Facades\Storage::disk('public')->exists($item->icon_url)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($item->icon_url);
        }
        
        $item->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
