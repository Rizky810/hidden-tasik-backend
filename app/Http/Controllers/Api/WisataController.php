<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Wisata;
use Illuminate\Http\Request;

class WisataController extends Controller
{
    // GET ALL
    public function index()
    {
        $wisatas = Wisata::all();

        return response()->json([
            'message' => 'success',
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
        ]);

        $wisata = Wisata::create($request->all());

        return response()->json([
            'message' => 'data berhasil ditambahkan',
            'data' => $wisata
        ], 201);
    }

    // GET DETAIL
    public function show($id)
    {
        $wisata = Wisata::find($id);

        if (!$wisata) {
            return response()->json([
                'message' => 'data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'message' => 'success',
            'data' => $wisata
        ], 200);
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $wisata = Wisata::find($id);

        if (!$wisata) {
            return response()->json([
                'message' => 'data tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'alamat' => 'required',
            'kategori' => 'required',
        ]);

        $wisata->update($request->all());

        return response()->json([
            'message' => 'data berhasil diupdate',
            'data' => $wisata
        ], 200);
    }

    // DELETE
    public function destroy($id)
    {
        $wisata = Wisata::find($id);

        if (!$wisata) {
            return response()->json([
                'message' => 'data tidak ditemukan'
            ], 404);
        }

        $wisata->delete();

        return response()->json([
            'message' => 'data berhasil dihapus'
        ], 200);
    }
}