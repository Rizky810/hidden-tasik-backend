<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        return response()->json(Message::all());
    }

    public function store(Request $request)
    {
        $item = Message::create($request->all());
        return response()->json($item, 201);
    }

    public function show($id)
    {
        $item = Message::find($id);
        if (!$item) return response()->json(['message' => 'Not Found'], 404);
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $item = Message::find($id);
        if (!$item) return response()->json(['message' => 'Not Found'], 404);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($id)
    {
        $item = Message::find($id);
        if (!$item) return response()->json(['message' => 'Not Found'], 404);
        $item->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
