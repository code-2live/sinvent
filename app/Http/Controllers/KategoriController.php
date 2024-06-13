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
    
    public function index()
    {
        
        $rsetKategori = Kategori::select('id','deskripsi','kategori',
             \DB::raw('(CASE
                 WHEN kategori = "M" THEN "Modal"
                 WHEN kategori = "A" THEN "Alat"
                 WHEN kategori = "BHP" THEN "Bahan Habis Pakai"
                 ELSE "Bahan Tidak Habis Pakai"
                 END) AS ketKategori'))
             ->paginate(10);
        // //  OK

        // $rsetKategori = DB::select('CALL getKategoriAll()','ketKategori("M")');
        // $rsetKategori = DB::raw("SELECT ketKategori("M") as someValue') ;

        // $rsetKategori = DB::table('kategori')
        //      ->select('id','deskripsi',DB::raw('ketKategori(kategori) as ketkategori'))
        //      ->get();

       // return $rsetKategori;


        // $rsetKategori = DB::table('kategori')
        //                 ->select('id','deskripsi',DB::raw('ketKategori(kategori) as ketkategori'))->paginate(1);



        //  return view('kategori.index',compact('rsetKategori'));

        // $rsetKategori = Kategori::all();
        // return view('kategori.relasi', compact('rsetKategori'));
        // $rsetKategori = Kategori::latest()->paginate(10);        
        // return view('kategori.index',compact('rsetKategori'));
        // $rsetKategori = Kategori::orderBy('id', 'asc')->paginate(10);
        return view('kategori.index', compact('rsetKategori'))-> with( 'i', (request()->input('page',1)-1)*10);


        return DB::table('kategori')->get();

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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->all();

        $this->validate($request, [
                'deskripsi' => 'required|unique:kategori,deskripsi',
                'kategori'  => 'required|in:M,A,BHP,BTHP',
            ]);


        //create post
        Kategori::create([
            'deskripsi'  => $request->deskripsi,
            'kategori'   => $request->kategori,
        ]);

        //redirect to index
        return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
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