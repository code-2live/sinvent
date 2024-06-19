<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kategori;
use App\Models\Barang;

class KategoriController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
{
    $query = Kategori::select('id', 'deskripsi', 'kategori')
                    ->addSelect(\DB::raw('(CASE
                         WHEN kategori = "M" THEN "Modal"
                         WHEN kategori = "A" THEN "Alat"
                         WHEN kategori = "BHP" THEN "Bahan Habis Pakai"
                         ELSE "Bahan Tidak Habis Pakai"
                         END) AS ketKategori'));

    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where('deskripsi', 'like', '%' . $search . '%')
              ->orWhere('kategori', 'like', '%' . $search . '%');
    }

    $rsetKategori = $query->latest()->paginate(10);

    return view('kategori.index', compact('rsetKategori'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $aKategori = array('blank'=>'Pilih Kategori',
                            'M'=>'Barang Modal',
                            'A'=>'Alat',
                            'BHP'=>'Bahan Habis Pakai',
                            'BTHP'=>'Bahan Tidak Habis Pakai'
                            );
        return view('kategori.create',compact('aKategori'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'deskripsi' => 'required|unique:kategori,deskripsi',
            'kategori'  => 'required|in:M,A,BHP,BTHP',
        ], [
            'deskripsi.unique' => 'Deskripsi sudah ada dalam database.',
        ]);
    
        // Create kategori
        Kategori::create([
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
        ]);
    
        // Redirect to index
        return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    

    public function show(string $id)
    {
        $rsetKategori = Kategori::find($id);

        // $rsetKategori = Kategori::select('id','deskripsi','kategori',
        //     \DB::raw('(CASE
        //         WHEN kategori = "M" THEN "Modal"
        //         WHEN kategori = "A" THEN "Alat"
        //         WHEN kategori = "BHP" THEN "Bahan Habis Pakai"
        //         ELSE "Bahan Tidak Habis Pakai"
        //         END) AS ketKategori'))->where('id', '=', $id);

        return view('kategori.show', compact('rsetKategori'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $aKategori = array(
            'blank' => 'Pilih Kategori',
            'M' => 'Barang Modal',
            'A' => 'Alat',
            'BHP' => 'Bahan Habis Pakai',
            'BTHP' => 'Bahan Tidak Habis Pakai'
        );
    
        $rsetKategori = Kategori::find($id);
    
        return view('kategori.edit', compact('rsetKategori', 'aKategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'deskripsi' => 'required',
            'kategori' => 'required | in:M,A,BHP,BTHP',
        ]);
    
        $rsetKategori = Kategori::find($id);
    
        // Update post
        $rsetKategori->update([
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
        ]);
    
        // Redirect ke index dengan notifikasi
        return redirect()->route('kategori.index')->with(['success' => 'Data berhasil diperbarui!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rsetKategori = Kategori::find($id);

        if (DB::table('barang')->where('kategori_id', $id)->exists()){
            return redirect()->route('kategori.index')->with(['Gagal' => 'Data Gagal Dihapus, karena ada barang dengan kategori yang sama!']);
        } else {
            $rsetKategori = Kategori::find($id);
            $rsetKategori->delete();
            return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }
    }
}