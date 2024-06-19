<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    function updateAPIKategori(Request $request, $kategori_id){
        $kategori = Kategori::find($kategori_id);

        if (null == $kategori){
            return response()->json(['status'=>"kategori tidak ditemukan"]);
        }

         $kategori->kategori= $request->kategori;
         $kategori->deskripsi = $request->deskripsi;
         $kategori->save();

        return response()->json(["status"=>"kategori berhasil diubah"]);
    }

    // function untuk membuat index api
    function showAPIKategori(Request $request){
        $kategori = Kategori::all();
        return response()->json($kategori);
    }

    function detailAPIKategori($id){
        $detail_kategori = Kategori::findOrFail($id);
        return response()->json($detail_kategori);
    }

    // function untuk create api
    function createAPIKategori(Request $request){
        $request->validate([
            'kategori' => 'required|in:M,A,BHP,BTHP',
            'deskripsi' => 'required|string|max:100',
        ]);

        // Simpan data kategori
        $kat = Kategori::create([
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
        ]);

        return response()->json(["status"=>"data berhasil dibuat"]);
    }

    // function untuk delete api
    function deleteAPIKategori($kategori_id){

        $del_kategori = Kategori::findOrFail($kategori_id);
        $del_kategori -> delete();

        return response()->json(["status"=>"data berhasil dihapus"]);
    }
}
