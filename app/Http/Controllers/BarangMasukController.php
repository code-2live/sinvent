<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;

use Illuminate\Http\Request;
use DB;

class BarangMasukController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        $rsetBarangMasuk = BarangMasuk::with('barang')->latest()->paginate(10);
        return view('barangmasuk.index', compact('rsetBarangMasuk'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }
    
    public function create()
    {
        $abarangmasuk = Barang::all();
        return view('barangmasuk.create',compact('abarangmasuk'));
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'tgl_masuk'     => 'required',
            'qty_masuk'     => 'required|numeric|min:1',
            'barang_id'     => 'required',
        ]);
        //create post
        BarangMasuk::create([
            'tgl_masuk'        => $request->tgl_masuk,
            'qty_masuk'        => $request->qty_masuk,
            'barang_id'        => $request->barang_id,
        ]);

        return redirect()->route('barangmasuk.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }


    public function show($id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);
        return view('barangmasuk.show', compact('barangMasuk'));
    }

    public function destroy($id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);

        $barangKeluar = BarangKeluar::where('barang_id', $id)->first();
        if ($barangKeluar) {
            return redirect()->route('barangmasuk.index')->with(['error' => 'Data Barang Masuk tidak dapat dihapus karena terdapat Barang Keluar yang terkait.']);
        }

        $barangMasuk->delete();

        return redirect()->route('barangmasuk.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
    
    public function edit($id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);
        $abarangmasuk = Barang::all();

        return view('barangmasuk.edit', compact('barangMasuk', 'abarangmasuk'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'tgl_masuk'     => 'required',
            'qty_masuk'     => 'required|numeric|min:1',
            'barang_id'     => 'required',
        ]);
        //create post
        $barangMasuk = BarangMasuk::findOrFail($id);
            $barangMasuk->update([
                'tgl_masuk' => $request->tgl_masuk,
                'qty_masuk' => $request->qty_masuk,
                'barang_id' => $request->barang_id,
            ]);

        return redirect()->route('barangmasuk.index')->with(['success' => 'Data Berhasil Diupdate!']);
    }

}
