<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Wisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WisataController extends Controller
{
    // GET ALL + SEARCH + FILTER + PAGINATION
    public function index(Request $request)
    {
        $query = Wisata::query();

        // Search berdasarkan nama
        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan kategori
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $wisatas = $query->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Data wisata berhasil diambil',
            'data' => $wisatas
        ], 200);
    }

    // CREATE
    public function store(Request $request)
{
    $request->validate([
        'nama' => 'required',
        'deskripsi' => 'required',
        'alamat' => 'required',
        'kategori' => 'required',
        'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $data = $request->only([
        'nama',
        'deskripsi',
        'alamat',
        'kategori'
    ]);

    if ($request->hasFile('gambar')) {
        $data['gambar'] = $request->file('gambar')->store('wisata', 'public');
    }

    $wisata = Wisata::create($data);

    return response()->json([
        'success' => true,
        'message' => 'Data wisata berhasil ditambahkan',
        'data' => $wisata
    ], 201);
}

    // GET DETAIL
    public function show($id)
    {
        $wisata = Wisata::find($id);

        if (!$wisata) {
            return response()->json([
                'success' => false,
                'message' => 'Data wisata tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail wisata berhasil diambil',
            'data' => $wisata
        ], 200);
    }

    // UPDATE
    public function update(Request $request, $id)
{
    $wisata = Wisata::find($id);

    if (!$wisata) {
        return response()->json([
            'success' => false,
            'message' => 'Data wisata tidak ditemukan'
        ], 404);
    }

    $request->validate([
        'nama' => 'required',
        'deskripsi' => 'required',
        'alamat' => 'required',
        'kategori' => 'required',
        'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $data = $request->only([
        'nama',
        'deskripsi',
        'alamat',
        'kategori'
    ]);

    if ($request->hasFile('gambar')) {

        // Hapus gambar lama jika ada
        if ($wisata->gambar && Storage::disk('public')->exists($wisata->gambar)) {
            Storage::disk('public')->delete($wisata->gambar);
        }

        // Upload gambar baru
        $data['gambar'] = $request->file('gambar')->store('wisata', 'public');
    }

    $wisata->update($data);

    return response()->json([
        'success' => true,
        'message' => 'Data wisata berhasil diupdate',
        'data' => $wisata
    ], 200);
}

    // DELETE
    public function destroy($id)
{
    $wisata = Wisata::find($id);

    if (!$wisata) {
        return response()->json([
            'success' => false,
            'message' => 'Data wisata tidak ditemukan'
        ], 404);
    }

    // Hapus gambar jika ada
    if ($wisata->gambar && Storage::disk('public')->exists($wisata->gambar)) {
        Storage::disk('public')->delete($wisata->gambar);
    }

    $wisata->delete();

    return response()->json([
        'success' => true,
        'message' => 'Data wisata berhasil dihapus'
    ], 200);
}
}